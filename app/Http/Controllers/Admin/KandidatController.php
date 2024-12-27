<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Kandidat;
use App\Repositories\KandidatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\ImageManagerStatic as Image;


class KandidatController extends Controller
{
    private $kandidatRepo, $logVotingRepo;

    public function __construct()
    {
        $this->kandidatRepo = new KandidatRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kandidats = $this->kandidatRepo->all();
        return view('admin.kandidat.index', compact('kandidats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kandidat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = Request()->validate([
            'nomor' => 'required',
            'nim' => 'required|unique:kandidats,nim|unique:users,nim',
            'nama' => 'required',
            'angkatan' => 'required',
            'foto' => 'required',
        ], [
            'nomor.required' => 'Masukkan nomor!',
            'nim.required' => 'Masukkan NIM!',
            'nim.unique' => 'NIM sudah terdaftar!',
            'nama.required' => 'Masukkan nama!',
            'angkatan.required' => 'Masukkan angkatan!',
            'foto.required' => 'Masukkan foto!',
        ]);

        DB::beginTransaction();
        try {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $photo_path = $request->file('foto')->storeAs('public/kandidat', $filename);
            //menghapus string 'public/' karena dapat menyulitkan pemanggilan di blade.

            $photo_path = str_replace('public/', '', $photo_path);

            $data = [
                'nomor' => $request->nomor,
                'nim' => $request->nim,
                'nama' => $request->nama,
                'angkatan' => $request->angkatan,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'foto' => $photo_path,
            ];
            Kandidat::create($data);
            DB::commit();
            Alert::success('Kandidat berhasil ditambahkan');
            return redirect('/admin/kandidat');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $kandidats = Kandidat::find($id);
        return view('admin.kandidat.show', compact('kandidats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kandidats = $this->kandidatRepo->find(Crypt::decrypt($id));
        return view('admin.kandidat.edit', compact('kandidats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Crypt::decrypt($id);
        $attributes = Request()->validate([
            'nomor' => 'required|unique:kandidats,nomor,' . $id,
            'nim' => 'required|unique:kandidats,nim,' . $id . '|unique:users,nim,' . $id,
            'nama' => 'required',
            'angkatan' => 'required',
        ], [
            'nomor.required' => 'Masukkan nomor!',
            'nomor.unique' => 'Nomor sudah digunakan!',
            'nim.required' => 'Masukkan NIM!',
            'nim.unique' => 'NIM sudah terdaftar!',
            'nama.required' => 'Masukkan nama!',
            'angkatan.required' => 'Masukkan angkatan!',
        ]);

        try {

            $kandidat = Kandidat::find($id);
            if ($request->foto) {
                Storage::delete('public/' . $kandidat->foto);
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                $photo_path = $request->file('foto')->storeAs('public/kandidat', $filename);
                //menghapus string 'public/' karena dapat menyulitkan pemanggilan di blade.
                $photo_path = str_replace('public/', '', $photo_path);

                $kandidat->foto = $photo_path;
            }

            $kandidat->nomor = $request->nomor;
            $kandidat->nama = $request->nama;
            $kandidat->angkatan = $request->angkatan;
            $kandidat->visi = $request->visi;
            $kandidat->misi = $request->misi;
            // if ($request->photo != '') {
            //     Storage::delete('public/' . $kandidat->photo);
            //     $kandidat->delete();
            // }
            $kandidat->save();

            Alert::success('Kandidat berhasil diupdate');
            return redirect(route('admin.kandidat.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kandidat = Kandidat::find($id);
        try {
            Storage::delete('public/' . $kandidat->photo);
            $kandidat->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        Alert::success('Kandidat berhasil dihapus');
        return redirect(route('admin.kandidat.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Exports\UsersExport;
use App\Mail\LoginTokenMail;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;


class MahasiswaController extends Controller
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepo->mahasiswa();
        // dd($this->userRepo->all());
        return view('admin.mahasiswa.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = Request()->validate([
            'nim' => 'required|unique:users,nim|unique:kandidats,nim',
            'nama' => 'required',
            'angkatan' => 'required',
            'token' => 'min:8',
        ], [
            'nim.required' => 'Masukkan NIM!',
            'nim.unique' => 'NIM sudah terdaftar!',
            'nama.required' => 'Masukkan nama!',
            'angkatan.required' => 'Masukkan angkatan!',
        ]);

        if ($request->token) {
            $pass = $request->token;
        } else {
            $pass = Str::random(8);
        };
        $email = $request->nim . '@mail.unej.ac.id';
        $data = [
            'nim' => $request->nim,
            'email' => $email,
            'nama' => $request->nama,
            'hp' => $request->hp,
            'angkatan' => $request->angkatan,
            'password' => bcrypt($pass),
            'token' => Crypt::encrypt($pass),
        ];

        DB::beginTransaction();
        try {
            $user = $this->userRepo->create($data);
            DB::commit();
            $user->assignRole('Umum');
            Alert::success('Berhasil', 'Data mahasiswa berhasil dibuat!');
            return redirect(route('admin.mahasiswa.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            // Alert::error('GAGAL', $th);
            // return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $mahasiswas = User::find($id);
        return view('admin.mahasiswa.show', compact('mahasiswas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $mahasiswas = User::find($id);
        return view('admin.mahasiswa.edit', compact('mahasiswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $user = User::find($id);
        $attributes = Request()->validate([
            'email' => 'required',
            'nama' => 'required',
            'hp' => 'required',
            'angkatan' => 'required',
        ]);
        $data = [
            'email' => $request->email,
            'nama' => $request->nama,
            'hp' => $request->hp,
            'angkatan' => $request->angkatan,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
            $data['token'] = Crypt::encrypt($request->password);
        }

        try {
            $user->update($data);
            Alert::success('Berhasil', 'Data mahasiswa berhasil diubah!');
            return redirect(route('admin.mahasiswa.index'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $user = User::find($id);

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            Alert::success('Berhasil', 'Data mahasiswa berhasil dihapus!');
            return redirect(route('admin.mahasiswa.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal menghapus', 'Pastikan mahasiswa belum vote!');
            return back();
        }
    }

    public function export_all()
    {
        return Excel::download(new UsersExport(1), 'Data HME all users.xlsx');
    }
    public function export_user()
    {
        return Excel::download(new UsersExport(2), 'Data HME user.xlsx');
    }
    public function export_admin()
    {
        return Excel::download(new UsersExport(3), 'Data HME admin.xlsx');
    }
    public function export_user_unvote()
    {
        return Excel::download(new UsersExport(4), 'Data HME user unvote.xlsx');
    }
    public function export_user_voted()
    {
        return Excel::download(new UsersExport(5), 'Data HME user voted.xlsx');
    }

    public function send_token(String $id)
    {
        try {
            $user = User::find(Crypt::decrypt($id));
            $token = Crypt::decrypt($user->token);
            $cleanEmail = str_replace(["\r", "\n"], '', $user->email);  // Clean the email address
            @Mail::to($cleanEmail)->send(new LoginTokenMail($token, $user));

            Alert::success('Email Behasil Dikirim');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::success('Email Behasil Dikirim');
            return redirect()->back();
            // throw $th;
        }
    }
}

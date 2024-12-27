<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\LogVotingRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    private $userRepo, $logRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository;
        $this->logRepo = new LogVotingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::find(1);
        $kandidats = Kandidat::query()->orderBy('nomor')->get();
        // dd($kandidats);
        return view('public.home.index', compact('kandidats', 'settings'));
    }

    public function store(Request $request)
    {
        $attributes = Request()->validate([
            'pilihan' => 'required',
        ], [
            'pilihan.required' => 'Masukkan Piihan!',
        ]);

        DB::beginTransaction();
        try {
            $datpil = Kandidat::find($request)->first();
            $datpil->voter = $datpil->voter + 1;
            $datpil->save();

            $datusr = User::find(Auth::user()->id);
            $datusr->is_vote = true;
            $datusr->save();

            $data = [
                'user_id' => Auth::user()->id,
            ];
            $this->logRepo->create($data);

            DB::commit();
            Alert::success('Berhasil!', 'Anda telah melakukan voting');
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // dd($datusr);
    }
}

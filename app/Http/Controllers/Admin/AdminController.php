<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Exports\UsersExport;
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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    private $user, $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository;

        $this->middleware(function ($request, $next) {
            $this->user = $this->userRepo->find(Auth::user()->id);
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepo->admin();
        // dd($users);
        // $users = User::all();
        return view('admin.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->user->hasPermissionTo('admin create')) {
            return view('admin.admin.create');
        } else {
            $url = url()->previous();
            return view('errors.403', compact('url'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($this->user->hasPermissionTo('admin create')) {
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

            // $passtok = Str::random(10)
            if ($request->token) {
                $pass = $request->token;
            } else {
                $pass = Str::random(8);
            };

            if ($request->email) {
                $email = $request->email;
            } else {
                $email = $request->nim . '@mail.unej.ac.id';
            };


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
                $user->assignRole($request->role);
                Alert::success('Berhasil', 'Data admin berhasil dibuat!');
                return redirect(route('admin.admin.index'));
            } catch (\Throwable $th) {
                DB::rollBack();
                dd($th);
                // Alert::error('GAGAL', $th);
                // return back();
            }
        } else {
            $url = url()->previous();
            return view('errors.403', compact('url'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $enc_id)
    {
        $id = Crypt::decrypt($enc_id);
        $admins = User::find($id);
        return view('admin.admin.show', compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $enc_id)
    {
        if ($this->user->hasPermissionTo('admin edit')) {
            $id = Crypt::decrypt($enc_id);
            $admins = User::find($id);
            return view('admin.admin.edit', compact('admins'));
        } else {
            $url = url()->previous();
            return view('errors.403', compact('url'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $enc_id)
    {
        if ($this->user->hasPermissionTo('admin edit')) {
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
                Alert::success('Berhasil', 'Data admin berhasil diubah!');
                return redirect(route('admin.admin.index'));
            } catch (\Throwable $th) {
                dd($th);
            }
        } else {
            $url = url()->previous();
            return view('errors.403', compact('url'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $enc_id)
    {
        if ($this->user->hasPermissionTo('admin delete')) {
            $id = Crypt::decrypt($enc_id);
            $user = User::find($id);
            try {
                $user->delete();
                Alert::success('Berhasil', 'Data admin berhasil dihapus!');
                return redirect(route('admin.admin.index'));
            } catch (\Throwable $th) {
                dd($th);
            }
        } else {
            $url = url()->previous();
            return view('errors.403', compact('url'));
        }
    }

    public function sendmail(String $id)
    {
        try {
            $user = User::find($id);
            Mail::to($user->email)->send(new SendMail($user));

            Alert::success('Email Behasil Dikirim');
            return redirect(back());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

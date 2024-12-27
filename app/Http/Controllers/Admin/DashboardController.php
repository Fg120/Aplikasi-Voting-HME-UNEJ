<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Kandidat;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superadmin = 'Superadmin';
        $admin = 'Admin';
        $umum = 'Umum';

        $userAll = User::with('roles')->get();
        $userUmum = $userAll->filter(function ($user) use ($umum) {
            return $user->roles->where('name', $umum)->isNotEmpty();
        });

        $total_users = $userUmum->count();
        $total_admins = $userAll->filter(function ($user) use ($superadmin, $admin) {
            return $user->roles->whereIn('name', [$superadmin, $admin])->isNotEmpty();
        })->count();
        $s_vote = $userUmum->filter(function ($user) {
            return $user->is_vote == 1;
        })->count();
        $b_vote = $userUmum->filter(function ($user) {
            return $user->is_vote == 0;
        })->count();
        // $users = User::with('roles')->get()->filter(function ($user) use ($umum) {
        //     return $user->roles->where('name', $umum)->isNotEmpty();
        // });
        // $total_users = User::with('roles')->get()->filter(function ($user) use ($umum) {
        //     return $user->roles->where('name', $umum)->isNotEmpty();
        // })->count();
        // $total_admins = User::with('roles')->get()->filter(function ($user) use ($superadmin, $admin) {
        //     return $user->roles->whereIn('name', [$superadmin, $admin])->isNotEmpty();
        // })->count();
        // $is_voted = $users->filter(function ($user) {
        //     return $user->is_vote == 1;
        // })->count();
        // $s_vote = User::where('is_vote', 1)->count();
        // $b_vote = User::where('is_vote', 0)->count();
        $kandidats = Kandidat::all()->count();
        return view('admin.dashboard', compact('total_users', 'total_admins', 'kandidats', 's_vote', 'b_vote'));
    }

    // FUNCTION SETTING
    public function setting()
    {
        $settings = Setting::all();
        return view('admin.setting.index', compact('settings'));
    }
    public function enable()
    {
        try {
            $settings = Setting::find(1);
            $settings->status = 1;
            $settings->save();

            Alert::success('Setting berhasil di aktifkan');
            return redirect(route('admin.setting.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function disable()
    {
        try {
            $settings = Setting::find(1);
            $settings->status = 0;
            $settings->save();

            Alert::success('Setting berhasil di noaktifkan');
            return redirect(route('admin.setting.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nim' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ];
        $messages = [
            'captcha.captcha' => 'Captcha tidak valid!',
        ];
        $validator = Validator::make($request->only('nim', 'password', 'captcha'), $rules, $messages);
        if ($validator->fails()) {
            // Alert::error('Gagal', "Data Keahlian gagal ditambahkan!");
            if ($validator->errors('captcha.captcha')) {
                Alert::error('Captcha tidak valid!');
            }
            return back()->withErrors($validator)->withInput();
        }

        $nim      = $request->input('nim');
        $password   = $request->input('password');

        if (auth()->attempt(['nim' => $nim, 'password' => $password])) {
            // Alert::success('Selamat Datang!');
            if (Auth()->user()->hasAnyRole(['Superadmin', 'Admin'])) {
                Session::put('login_time', now());
                return redirect(route('admin.dashboard'));
            } else {
                return redirect('/');
            }
        } else {
            Alert::error('Gagal!', 'NIM atau password salah!');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}

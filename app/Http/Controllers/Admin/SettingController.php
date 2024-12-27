<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function setting()
    {
        $settings = Setting::all();
        return view('admin.voting.setting', compact('settings'));
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
    public function schedule(Request $request)
    {
        $data = [
            'start_date' => $request->start_date . ':00',
            'end_date' => $request->end_date . ':00'
        ];
        // dd(json_encode($data));
        try {
            $settings = Setting::find(1);
            $settings->status = 2;
            $settings->json = json_encode($data);
            $settings->save();

            Alert::success('Setting Voting Berhasil Dijadwalkan');
            return redirect(route('admin.setting.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

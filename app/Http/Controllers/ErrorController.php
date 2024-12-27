<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error403()
    {
        $url = session('url');
        return view('errors.403', compact('url'));
    }
}

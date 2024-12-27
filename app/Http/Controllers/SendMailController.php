<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index()
    {

        Mail::to("anwaria1404@gmail.com")->send(new SendMail());

        return "Email telah dikirim";
    }
}

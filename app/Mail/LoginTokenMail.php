<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginTokenMail extends Mailable
{
    public $data; // The data variable to pass into the view

    public function __construct($token, $user)
    {
        // Assuming $user is an object, and $token is a string
        $this->data = [
            'token' => $token,
            'user' => [
                'nama' => $user->nama // Replace 'name' with the correct field from your user model
            ]
        ];
    }

    public function build()
    {
        return $this->view('emails.login-token')  // This should match the view you provided earlier
            ->with(['data' => $this->data])
            ->subject('Login Token')
            ->replyTo('no-reply@example.com');
    }
}
// class LoginTokenMail extends Mailable
// {
//     public $token;
//     public $user;

//     public function __construct($token, $user)
//     {
//         $this->token = $token;
//         $this->user = $user;
//     }

//     public function build()
//     {
//         return $this->view('emails.login-token')
//             ->with('data', [
//                 'token' => $this->token,
//                 'user'  => $this->user,
//             ]);
//     }


//     // public function build()
//     // {
//     //     return $this->view('emails.login-token') // Set the view
//     //         ->with([
//     //             'token' => $this->token,
//     //             'user'  => $this->user,
//     //         ])
//     //         ->subject('Login Token'); // Optional: add a subject
//     // }
// }

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Komisi Pemilihan Kahim - Token',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function test()
    // {
    // }
    public function build()
    {
        // dd($this->data);
        return $this->from('token@pemilihanketuahme2024.kencang.id')
            ->view('mail')
            ->with(
                [
                    'users' => $this->data,
                ]
            );
    }

    public function content(): Content
    {
        $url = config('app.url');
        return new Content(
            markdown: 'mail',
            with: [
                'url' => $url,
            ]
        );
    }
}

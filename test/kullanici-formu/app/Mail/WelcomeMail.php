<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user; // kullanıcıyı direk al
    }

    public function build()
    {
        return $this->view('emails.welcome')
                    ->with(['user' => $this->user]); // kullanıcıyı view ekranına gönder
    }
}
 

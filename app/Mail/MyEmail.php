<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name = 'Guest')
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Test Email dari Laravel')
                    ->view('Mail.myEmail')
                    ->with(['name' => $this->name]);
    }
}
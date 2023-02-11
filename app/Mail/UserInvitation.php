<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvitation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ub.online.counseling@gmail.com')->subject('User Invitation')
        ->view('partials.user-invitation')
        ->with('token',$this->token)
        ->with('name',$this->name);
        //return $this->view('view.name');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $section;
    public $number;
    public $message;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $section, $number, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->section = $section;
        $this->number = $number;
        $this->message = $message;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ub.online.counseling@gmail.com')
        ->subject('Inquiry from UB Online Counseling Website')
        ->view('partials.inquiry-from-external')
        ->with('name', $this->name)
        ->with('email', $this->email)
        ->with('section',$this->section)
        ->with('number', $this->number)
        ->with('content', $this->message);
        //return $this->view('view.name');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class sendMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $_email = "";
    private $_firstname = "";
    private $_lastname = "";
    private $_token = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->_email = $data["email"];
        $this->_firstname = $data["firstname"];
        $this->_lastname = $data["lastname"];
        $this->_token = $data["token"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("rachidbensaid01@gmail.com")->view('mails.confirmation')->with(
        array(
            'email' => $this->_email,
            'firstname' => $this->_firstname,
            'lastname' => $this->_lastname,
            'token' => $this->_token
        ));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Auth;   
class registerMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
      $this->user=$user; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Account Review")
        ->markdown('emails.reviewAccount')
        ->with(array("user"=>$this->user));     


        // return $this->subject( "Welcome ::))")
        // ->markdown('email.registmessage')
        // ->with(array('user'=>$this->name,'email'=>$this->email) )  ;
}

}

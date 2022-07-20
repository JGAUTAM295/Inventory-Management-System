<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeResetPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
//     public function build()
//     {
//       // return $this->view('view.name');

// 	return $this->from('jyoti.610weblab@gmail.com')
// 		->markdown('emails.send-code-reset-password')
// 		->with('email', 'jyoti.610weblab@gmail.com');
//         //return $this->markdown('emails.send-code-reset-password')->with('code', $this->code);
//     }

public function build()
    {
    
        return $this->from('jyoti.610weblab@gmail.com')
        ->subject('Mail from IEMS')
        ->view('emails.send_code_reset_password')->with('code', $this->code);
        
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $sub;
     public $mes;

    public function __construct($subject, $massage)
    {
        $this->sub = $subject;
        $this->mes = $massage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_subject = $this->sub;
        $e_massage = $this->mes;

        return $this->view('mail.SendEmail', compact("e_massage"))->subject($e_subject);
    }
}

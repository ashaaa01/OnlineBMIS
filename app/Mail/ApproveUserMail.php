<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApproveUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(protected $request)
    {
       //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('obmis2024@gmail.com', 'OBMIS')
        //             ->subject($this->request->new_status.' User')
        //             ->view('mail.approve_user')
        //             ->with([
        //                 'request' => $this->request,
        //             ]);
        return $this->subject($this->request['new_status'].' User')
        ->view('mail.approve_user')->with(['request' => $this->request]);
    }
}

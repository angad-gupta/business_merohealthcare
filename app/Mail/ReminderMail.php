<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$subject,$content,$url;

    public function __construct(User $user, $subject, $content, $url)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->content = $content;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('emails.reminder')->with('user',$this->user)->with('url',$this->url)->with('content',$this->content);
    }
}

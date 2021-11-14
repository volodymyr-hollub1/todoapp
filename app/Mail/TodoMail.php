<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TodoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $todo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $todo)
    {
        $this->username = $username;
        $this->todo = $todo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('New message!')
            ->view('mail.todo-mail')
            ->with([
                'username' => $this->username,
                'todo' => $this->todo
            ]);
    }
}

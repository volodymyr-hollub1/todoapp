<?php

namespace App\Listeners;

use App\Mail\TodoMail;
use App\Events\TodoMailEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue as SQ;

class TodoMailListener implements SQ
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TodoMailEvent  $event
     * @return void
     */
    public function handle(TodoMailEvent $event)
    {
        Mail::to(config())->send(new TodoMail($event->data->username, $event->data->todo));
    }
}

<?php

namespace App\Listeners;

use App\Mail\ActivationEmail;
use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $message = (new ActivationEmail($event->user, $event->token))
            ->onQueue('emails_activation');

        Mail::to($event->user)->queue($message);
    }
}

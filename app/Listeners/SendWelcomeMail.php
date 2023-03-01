<?php

namespace App\Listeners;

use App\Events\UserCreated;

use App\Mail\WelcomeUser;

use App\Models\TMP;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event)
    {


        Mail::to($event->user->email)->send(new WelcomeUser($event->user->firstname." ".$event->user->lastname,'this suppose to be some writing'));
    }
}

<?php

namespace Callmeaf\User\Listeners;

use Callmeaf\User\Mails\WelcomeMail;
use Callmeaf\User\Events\UserStored;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMailToUser
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
    public function handle(UserStored $event): void
    {
        $email = $event->user->email;
        if($email) {
            Mail::to($email)->send(new WelcomeMail());
        }
    }
}

<?php

namespace Callmeaf\User\Listeners;

use Callmeaf\User\Events\UserForceDestroyed;

class DetachRolesPivotByUser
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
    public function handle(UserForceDestroyed $event): void
    {
        $event->user->roles()->detach();
    }
}

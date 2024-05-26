<?php

namespace Callmeaf\User\Events;

use Callmeaf\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDestroyed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public User $user)
    {

    }
}

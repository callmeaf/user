<?php

namespace Callmeaf\User\Events;

use Callmeaf\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;

class UserTrashed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public LengthAwarePaginator|Collection|\Illuminate\Support\Collection|null $users)
    {

    }
}

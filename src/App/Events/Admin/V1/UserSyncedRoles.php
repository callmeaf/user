<?php

namespace Callmeaf\User\App\Events\Admin\V1;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSyncedRoles
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param User $user
     * @param array $attachedRolesNames
     * @param array $detachedRolesNames
     * @param array $updatedRolesName
     */
    public function __construct(public User $user,public array $attachedRolesNames,public array $detachedRolesNames,public array $updatedRolesName)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

<?php

namespace Callmeaf\User\App\Listeners\Admin\V1;

use Callmeaf\User\App\Events\Admin\V1\UserSyncedRoles;
use Callmeaf\User\App\Notifications\Admin\V1\UserRoleUpdatedNotification;

class NotifyUserOfUpdatedRoles
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
    public function handle(UserSyncedRoles $event): void
    {
        $attachedRolesNames = collect($event->attachedRolesNames);
        $detachedRolesNames = collect($event->detachedRolesNames);
        $updatedRolesNames = collect($event->updatedRolesName);

        if($attachedRolesNames->isEmpty() && $detachedRolesNames->isEmpty() && $updatedRolesNames->isEmpty()) {
            return;
        }

        $user = $event->user;

        $user->notify(new UserRoleUpdatedNotification(user: $user,attachedRolesNames: $attachedRolesNames->toArray(),detachedRolesNames: $detachedRolesNames->toArray(),updatedRolesNames: $updatedRolesNames->toArray()));
    }
}

<?php

namespace Callmeaf\User\Listeners;

use Callmeaf\User\Events\UserStored;

class SendWelcomeSmsToUser
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
        $user = $event->user;
        $mobile = $user->mobile;
        if($mobile) {
            $authService = app(config('callmeaf-auth.service'));
            $authService->smsChannel()->sendViaPattern(
                pattern: config('callmeaf-kavenegar.patterns.welcome.template'),
                mobile: $mobile,
                values: [
                    $user->first_name ?? '',
                ],
            );
        }
    }
}

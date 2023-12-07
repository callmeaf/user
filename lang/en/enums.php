<?php

use Callmeaf\User\Enums\UserStatus;
use Callmeaf\User\Enums\UserType;

return [
    UserStatus::class => [
        UserStatus::ACTIVE->name => 'Active',
        UserStatus::INACTIVE->name => 'InActive',
    ],
    UserType::class => [
        UserType::NORMAL->name => 'Normal',
        UserType::VIP->name => 'VIP',
    ],
];

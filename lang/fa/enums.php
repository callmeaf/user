<?php

use Callmeaf\User\Enums\UserStatus;
use Callmeaf\User\Enums\UserType;

return [
    UserStatus::class => [
        UserStatus::ACTIVE->name => 'فعال',
        UserStatus::INACTIVE->name => 'غیر فعال',
    ],
    UserType::class => [
        UserType::NORMAL->name => 'معمولی',
        UserType::VIP->name => 'ویژه',
    ],
];

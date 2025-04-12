<?php

namespace Callmeaf\User\App\Enums;


use Callmeaf\Base\App\Enums\BaseStatus;

enum UserStatus: string
{
    case ACTIVE = BaseStatus::ACTIVE->value;
    case INACTIVE = BaseStatus::INACTIVE->value;
    case PENDING = BaseStatus::PENDING->value;
}

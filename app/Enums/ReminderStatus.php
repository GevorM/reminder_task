<?php

namespace App\Enums;

enum ReminderStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}

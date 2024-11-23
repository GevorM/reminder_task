<?php

namespace App\Enums;

enum ReminderTypes: string
{
    case PRE = 'pre-expiration';
    case POST = 'post-expiration';
}

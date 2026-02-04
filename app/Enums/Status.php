<?php

namespace App\Enums;

enum Status: string
{
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case SUSPENDED = 'suspended';
    case CANCELLED = 'cancelled';
}
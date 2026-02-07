<?php

namespace App\Enums;

enum CompletionStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
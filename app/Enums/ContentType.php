<?php

namespace App\Enums;

enum ContentType: string
{
    case VIDEO = 'video';
    case AUDIO = 'audio';
    case PDF = 'pdf';
    case TEXT = 'text';
}
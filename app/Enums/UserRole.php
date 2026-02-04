<?php

namespace App\Enums;

enum UserRole: string
{
    // Platform
    case SUPER_ADMIN        = 'super_admin';
    case PLATFORM_SUPPORT   = 'platform_support';
    case PLATFORM_FINANCE   = 'platform_finance';

    // Organization
    case ORG_ADMIN          = 'org_admin';
    case ORG_MANAGER        = 'org_manager';
    case CONTENT_ADMIN      = 'content_admin';

    // Course
    case INSTRUCTOR         = 'instructor';
    case TEACHING_ASSISTANT = 'teaching_assistant';

    // Learner
    case STUDENT            = 'student';
    case GUEST              = 'guest';
}

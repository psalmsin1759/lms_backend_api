<?php

namespace App\Enums;

enum Permission: string
{
    // Users & org
    case MANAGE_ORGANIZATION = 'manage_organization';
    case MANAGE_USERS        = 'manage_users';
    case ENROLL_USERS        = 'enroll_users';

    // Courses
    case CREATE_COURSE       = 'create_course';
    case UPDATE_COURSE       = 'update_course';
    case PUBLISH_COURSE      = 'publish_course';
    case DELETE_COURSE       = 'delete_course';

    // Content
    case CREATE_LESSON       = 'create_lesson';
    case UPDATE_LESSON       = 'update_lesson';

    // Assessment
    case CREATE_QUIZ         = 'create_quiz';
    case GRADE_ASSIGNMENT   = 'grade_assignment';

    // Certification
    case ISSUE_CERTIFICATE  = 'issue_certificate';

    // Platform
    case MANAGE_BILLING     = 'manage_billing';
    case VIEW_ANALYTICS     = 'view_analytics';
}

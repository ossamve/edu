<?php

namespace App\Enum;

enum UserRole: string
{
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';
    case GUEST = 'ROLE_GUEST';
    case TEACHER = 'ROLE_TEACHER';
    case STUDENT = 'ROLE_STUDENT';
}

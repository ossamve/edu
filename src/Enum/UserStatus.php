<?php

namespace App\Enum;

enum UserStatus: string
{
    case CREATED = "CREATED";
    case ACTIVE = "ACTIVE";
    case BLOCKED = "BLOCKED";
    case DELETED = "DELETED";

}

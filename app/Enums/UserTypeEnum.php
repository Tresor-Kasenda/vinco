<?php

namespace App\Enums;

/**
 * Class UserTpeEnum
 *
 * This class is an enumeration of the different types of users in the system.
 * It contains two types of users: 'student' and 'school_management'.
 *
 * @package App\Enums
 */
enum UserTypeEnum: string
{
    /**
     * Represents a student user.
     */
    case USER_STUDENT = "student";

    /**
     * Represents a school management user.
     */
    case USER_SCHOOL_MANAGEMENT = "school_management";
}

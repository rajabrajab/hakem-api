<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case PATIENT = 'patient';
    case FAMILY = 'family';
    case DOCTOR = 'doctor';
    case SUPPORT = 'support';

}

<?php 

namespace App\Enum;

enum AccountCreationStatus
{
    case ALREADY_EXISTS;
    case FAILED;
    case SUCCESS;
    case AUTHKEY_ALREADY_EXISTS;
}

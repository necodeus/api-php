<?php 

namespace App\Enum;

enum AccountCreationResponse
{
    case ALREADY_EXISTS;
    case FAILED;
    case SUCCESS;
}

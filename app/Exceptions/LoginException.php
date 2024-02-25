<?php

namespace App\Exceptions;

use Exception;

class LoginException extends Exception
{
    protected $message = 'Login Failure';
}

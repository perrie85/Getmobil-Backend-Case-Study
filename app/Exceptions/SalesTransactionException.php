<?php

namespace App\Exceptions;

use Exception;

class SalesTransactionException extends Exception
{
    protected $message = 'Sales Transaction Failure.';
    protected $code = 500;
}

<?php

namespace App\Exceptions;

use Exception;

class ProductNotAvailableException extends Exception
{
    protected $message = 'Product not available';
    protected $code = 404;
}

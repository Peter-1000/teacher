<?php

namespace App\Exceptions;

use Exception;

class SchedulingConflictException extends Exception
{
    protected $message = "There is a scheduling conflict with another class for this teacher.";
    protected $code = 422;

    public function __construct()
    {
        parent::__construct($this->message, $this->code);
    }
}

<?php

namespace src\Exceptions;

use \Exception;

class InvalidResultDetail extends \Exception{

    public array $errors;

    public function __construct($error)
    {
        $this->errors = $error;
    }



}
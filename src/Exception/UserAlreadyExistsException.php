<?php

namespace App\Exception;

use RuntimeException;

class UserAlreadyExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Пользователь с таким логином уже существует!');
    }

}
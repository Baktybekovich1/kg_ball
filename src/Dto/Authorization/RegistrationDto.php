<?php

namespace App\Dto\Authorization;

class RegistrationDto
{
    public function __construct(
        public string $username,
        public string $password,
    )
    {
    }

}
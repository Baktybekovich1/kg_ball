<?php

namespace App\Dto\Team;

class EditTeamDto
{
    public function __construct(
        public string      $title,
        public string|null $logo
    )
    {
    }

}
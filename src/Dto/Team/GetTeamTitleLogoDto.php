<?php

namespace App\Dto\Team;

class GetTeamTitleLogoDto
{
    public function __construct(
        public string $title,
        public string|null $logo
    )
    {
    }

}
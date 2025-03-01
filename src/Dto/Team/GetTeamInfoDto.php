<?php

namespace App\Dto\Team;

class GetTeamInfoDto
{
    public function __construct(
        public int $id,
        public string $teamTitle,
        public string|null $teamLogo
    )
    {
    }

}
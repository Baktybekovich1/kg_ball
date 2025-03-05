<?php

namespace App\Dto\Team;

class GetTeamSquadListDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $teamTitle,
        public string $position,
        public string|null $img
    )
    {
    }

}
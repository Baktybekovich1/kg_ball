<?php

namespace App\Dto\Team;

class GetTeamGameInfoDto
{
    public function __construct(
        public int $allGames,
        public int $goals,
        public int $penalty,
        public int $assists
    )
    {
    }

}
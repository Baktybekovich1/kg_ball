<?php

namespace App\Dto\Team;

class GetTeamGameListDto
{
    public function __construct(
        public int $id,
        public array $homeTeam,
        public array $awayTeam,
        public array $tourney,
    )
    {
    }

}
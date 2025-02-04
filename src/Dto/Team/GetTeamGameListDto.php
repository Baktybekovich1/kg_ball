<?php

namespace App\Dto\Team;

class GetTeamGameListDto
{
    public function __construct(
        public int $id,
        public array $winnerTeam,
        public array $loserTeam,
        public array $tourney,
    )
    {
    }

}
<?php

namespace App\Dto\Game;

class GetGameDto
{
    public function __construct(
        public int    $tourneyId,
        public string $tourneyTitle,
        public int    $winnerTeamId,
        public string $winnerTeamTitle,
        public string $winnerTeamGoals,
        public int    $loserTeamId,
        public string $loserTeamTitle,
        public string $loserTeamGoals,
    )
    {
    }

}
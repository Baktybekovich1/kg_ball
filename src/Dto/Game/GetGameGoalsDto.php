<?php

namespace App\Dto\Game;

class GetGameGoalsDto
{
    public function __construct(
        public int    $winnerTeamId,
        public string $winnerTeamTitle,
        public array  $winnerTeamGoals,
        public int    $loserTeamId,
        public string $loserTeamTitle,
        public array  $loserTeamGoals
    )
    {
    }

}
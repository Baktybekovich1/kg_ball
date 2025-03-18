<?php

namespace App\Dto\Game;

class GetGameGoalsDto
{
    public function __construct(
        public array $winnerTeamGoals,
        public array $loserTeamGoals
    )
    {
    }

}
<?php

namespace App\Dto\Game;

use App\Dto\Goal\GetGoalInfoDto;

class GetGameGoalsDto
{
    public function __construct(
        public array $winnerTeamGoals,
        public array $loserTeamGoals
    )
    {
    }

}
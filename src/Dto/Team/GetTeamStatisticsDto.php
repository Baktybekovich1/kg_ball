<?php

namespace App\Dto\Team;

use App\Dto\Player\GetPlayerNameAndAssists;
use App\Dto\Player\GetPlayerNameAndGoals;

class GetTeamStatisticsDto
{
    public function __construct(
        public int                     $teamId,
        public int                     $winning,
        public int                     $goals,
        public int                     $assists,
        public GetPlayerNameAndGoals   $bombardier,
        public GetPlayerNameAndAssists $assistant
    )
    {
    }

}
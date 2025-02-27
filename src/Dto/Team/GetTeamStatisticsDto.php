<?php

namespace App\Dto\Team;

use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;

class GetTeamStatisticsDto
{
    public function __construct(
        public int                        $teamId,
        public int                        $winning,
        public int                        $goals,
        public int                        $assists,
        public GetPlayerNameAndGoalsDto   $bombardier,
        public GetPlayerNameAndAssistsDto $assistant
    )
    {
    }

}
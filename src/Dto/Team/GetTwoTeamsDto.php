<?php

namespace App\Dto\Team;

class GetTwoTeamsDto
{
    public function __construct(
        public GetTeamStatisticsDto $firstTeam,
        public GetTeamStatisticsDto $secondTeam
    )
    {
    }

}
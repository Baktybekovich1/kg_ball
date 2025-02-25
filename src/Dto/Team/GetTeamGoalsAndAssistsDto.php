<?php

namespace App\Dto\Team;

class GetTeamGoalsAndAssistsDto
{
    public function __construct(
        public int    $teamId,
        public string $teamTitle,
        public int    $goalsCount,
        public int    $assistsCount,
    )
    {
    }

}
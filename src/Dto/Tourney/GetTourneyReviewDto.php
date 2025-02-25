<?php

namespace App\Dto\Tourney;

use App\Dto\Player\GetPlayerNameAndAssists;
use App\Dto\Player\GetPlayerNameAndGoals;
use App\Dto\Team\GetTeamGoalsAndAssistsDto;

class GetTourneyReviewDto
{
    public function __construct(
        public ?int                       $tourneyId,
        public ?int                       $teamsCount,
        public ?int                       $gamesCount,
        public ?GetTeamGoalsAndAssistsDto $firstPosition,
        public ?GetTeamGoalsAndAssistsDto $secondPosition,
        public ?GetTeamGoalsAndAssistsDto $thirdPosition,
        public ?GetPlayerNameAndGoals     $bombardier,
        public ?GetPlayerNameAndAssists   $assistant,
        public ?int                       $goalsCount,
        public ?int                       $assistsCount,
    )
    {
    }

}
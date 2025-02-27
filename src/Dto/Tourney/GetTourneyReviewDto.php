<?php

namespace App\Dto\Tourney;

use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;
use App\Dto\Team\GetTeamGoalsAndAssistsDto;

class GetTourneyReviewDto
{
    public function __construct(
        public ?int                        $tourneyId,
        public ?int                        $teamsCount,
        public ?int                        $gamesCount,
        public ?GetTeamGoalsAndAssistsDto  $firstPosition,
        public ?GetTeamGoalsAndAssistsDto  $secondPosition,
        public ?GetTeamGoalsAndAssistsDto  $thirdPosition,
        public ?GetPlayerNameAndGoalsDto   $bombardier,
        public ?GetPlayerNameAndAssistsDto $assistant,
        public ?int                        $goalsCount,
        public ?int                        $assistsCount,
    )
    {
    }

}
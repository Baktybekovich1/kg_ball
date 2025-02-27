<?php

namespace App\Dto\Goal;

use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;
use App\Dto\Player\GetPlayerNameDto;

class GetGoalInfoDto
{

    public function __construct(
        public int                       $goalId,
        public GetPlayerNameDto  $goalAuthor,
        public ?GetPlayerNameDto $assistAuthor = null,
    )
    {
    }
}
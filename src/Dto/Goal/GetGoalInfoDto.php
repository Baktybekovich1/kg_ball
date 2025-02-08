<?php

namespace App\Dto\Goal;

use App\Dto\Player\GetPlayerNameAndGoals;

class GetGoalInfoDto
{

    public function __construct(
        public int                    $goalId,
        public GetPlayerNameAndGoals  $goalAuthor,
        public ?GetPlayerNameAndGoals $assistAuthor = null,
    )
    {
    }
}
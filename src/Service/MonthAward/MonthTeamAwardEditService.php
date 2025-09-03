<?php

namespace App\Service\MonthAward;

use App\Repository\MonthTeamAwardRepository;
use App\Repository\TeamRepository;

class MonthTeamAwardEditService
{
    public function __construct(
        private MonthTeamAwardRepository $monthTeamAwardRepository,
        private readonly TeamRepository $teamRepository,
    )
    {
    }

    public function add($dto,$monthId):bool
    {


    }

}
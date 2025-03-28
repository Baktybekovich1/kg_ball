<?php

namespace App\Dto\Tourney\TourneyPrizes;

class GetTourneyPrizesDto
{
    public function __construct(
        public int    $prizesId,
        public int    $firstPositionTeamId,
        public string $firstPositionTeamTitle,
        public int    $secondPositionTeamId,
        public string $secondPositionTeamTitle,
        public int    $thirdPositionTeamId,
        public string $thirdPositionTeamTitle,
    )
    {
    }

}
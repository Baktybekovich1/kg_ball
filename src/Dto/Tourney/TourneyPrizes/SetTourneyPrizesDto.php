<?php

namespace App\Dto\Tourney\TourneyPrizes;

class SetTourneyPrizesDto
{
    public function __construct(
        public int $tourneyId,
        public int $firstPositionId,
        public int $secondPositionId,
        public int $thirdPositionId,
    )
    {
    }

}
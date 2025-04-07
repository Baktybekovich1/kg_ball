<?php

namespace App\Dto\Team;

class GetTeamPrizesDto
{
    public function __construct(
        public array|null $firstPositionPrizes,
        public array|null $secondPositionPrizes,
        public array|null $thirdPositionPrizes,
    )
    {
    }

}
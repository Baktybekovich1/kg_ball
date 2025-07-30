<?php

namespace App\Dto\Prizes\PlayerPrizes;

use App\Dto\Player\GetPlayerNameDto;

class SetTourneyPlayerPrizesDto
{
    public function __construct(
        public int $tourneyId,
        public int $goalkeeperId,
        public int $defenderId
    )
    {
    }

}
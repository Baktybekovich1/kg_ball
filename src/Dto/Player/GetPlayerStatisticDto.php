<?php

namespace App\Dto\Player;

class GetPlayerStatisticDto
{
    public function __construct(
        public int $goals,
        public int $goalInGames,
        public int $penalties,
        public int $assists,
    )
    {
    }

}
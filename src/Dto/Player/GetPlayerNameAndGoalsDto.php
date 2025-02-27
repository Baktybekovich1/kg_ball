<?php

namespace App\Dto\Player;

class GetPlayerNameAndGoalsDto
{
    public function __construct(
        public int $playerId,
        public string $playerName,
        public int $goalsCount
    )
    {
    }

}
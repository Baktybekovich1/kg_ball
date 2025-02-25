<?php

namespace App\Dto\Player;

class GetPlayerNameAndGoals
{
    public function __construct(
        public int $playerId,
        public string $playerName,
        public int $goalsCount
    )
    {
    }

}
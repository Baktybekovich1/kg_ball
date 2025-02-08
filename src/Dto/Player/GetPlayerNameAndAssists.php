<?php

namespace App\Dto\Player;

class GetPlayerNameAndAssists
{

    public function __construct(
        public int $playerId,
        public string $playerName,
        public int $assistsCount
    )
    {
    }
}
<?php

namespace App\Dto\Player;

class GetPlayerNameAndAssistsDto
{
    public function __construct(
        public int    $playerId,
        public string $playerName,
        public int $assistsCount
    )
    {
    }

}
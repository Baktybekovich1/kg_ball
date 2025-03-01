<?php

namespace App\Dto\Player;

class GetPlayerNameAndAssistsDto
{
    public function __construct(
        public int|null    $playerId,
        public string|null $playerName,
        public int|null $assistsCount
    )
    {
    }

}
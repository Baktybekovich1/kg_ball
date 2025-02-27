<?php

namespace App\Dto\Player;

class GetPlayerNameDto
{
    public function __construct(
        public int    $playerId,
        public string $playerName
    )
    {
    }

}
<?php

namespace App\Dto\Player;

class GetPlayerG_A_TeamDto
{
    public function __construct(
        public int    $playerId,
        public string $playerName,
        public string|null $playerImg,
        public string $teamTitle,
        public int    $goals,
        public int    $assists,
    )
    {
    }

}
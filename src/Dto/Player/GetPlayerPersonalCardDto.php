<?php

namespace App\Dto\Player;

readonly class GetPlayerPersonalCardDto
{
    public function __construct(
        public int    $playerId,
        public string $name,
        public string $birthday,
        public string $position,
        public int    $teamId,
        public string $teamTitle

    )
    {
    }
}
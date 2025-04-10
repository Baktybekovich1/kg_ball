<?php

namespace App\Dto\Player;

class TransferDto
{
    public function __construct(
        public int $playerId,
        public int $teamId,
    )
    {
    }

}
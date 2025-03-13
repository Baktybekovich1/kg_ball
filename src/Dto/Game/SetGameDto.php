<?php

namespace App\Dto\Game;

class SetGameDto
{
    public function __construct(
        public int $tourneyId,
        public int $winnerTeamId,
        public int $loserTeamId,
    )
    {
    }

}
<?php

namespace App\Dto\Game;

class GetAssistsInGameDto
{
    public function __construct(
        public array $winnerTeamAssists,
        public array $loserTeamAssists
    )
    {
    }

}
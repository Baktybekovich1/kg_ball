<?php

namespace App\Dto\Game;

class GetGameScoresDto
{
    public function __construct(
        public int $gameId,
        public int $winnerTeamId,
        public string $winnerTeamTitle,
        public int $winnerTeamScore,
        public int $loserTeamId,
        public string $loserTeamTitle,
        public int $loserTeamScore,
    )
{
}

}
<?php

namespace App\Dto\Team;

class GetTeamPointsDto
{
    public function __construct(
        public int $id,
        public string $title,
        public string|null $logo,
        public int|null $games,
        public int|null $winnerGames,
        public int|null $loseGames,
        public int|null $assists,
        public int|null $goals,
        public int|null $points
    )
    {
    }

}
<?php

namespace App\Class;

use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;

class Transfer
{
    public function __construct(
        public Player                     $player,
        public Team                       $team,
        private readonly PlayerRepository $playerRepository,
    )
    {
    }

    public function push(): true
    {
        $this->player->setTeam($this->team);
        return $this->playerRepository->save($this->player);
    }

}
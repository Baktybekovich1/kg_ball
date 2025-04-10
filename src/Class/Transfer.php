<?php

namespace App\Class;

use App\Entity\Player;
use App\Entity\Team;
use App\Repository\PlayerRepository;

class Transfer
{
    public function __construct(
        public Player                     $player,
        public Team                       $team
    )
    {
    }

    public function push(PlayerRepository $playerRepository): true
    {

    }

}
<?php

namespace App\Dto\Player;

class EditPlayerDto
{
    public function __construct(
        public int    $teamId,
        public string $name,
        public string $surname,
        public string $position,
        public string $birthday,
        public string $img
    )
    {
    }

}
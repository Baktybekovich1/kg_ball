<?php

namespace App\Dto\Player;

class GetPlayerListDto
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $position,
        public string|null $img,
        public int    $teamId,
        public string $teamName
    )
    {
    }

}
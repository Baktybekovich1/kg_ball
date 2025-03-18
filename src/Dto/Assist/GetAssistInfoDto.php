<?php

namespace App\Dto\Assist;

use App\Dto\Player\GetPlayerNameDto;

class GetAssistInfoDto
{
    public function __construct(
        public int|null          $assistId,
        public ?GetPlayerNameDto $assistAuthor = null
    )
    {
    }

}
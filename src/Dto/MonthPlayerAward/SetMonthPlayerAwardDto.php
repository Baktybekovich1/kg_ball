<?php

namespace App\Dto\MonthPlayerAward;

class SetMonthPlayerAwardDto
{
    public function __construct(
        public string $name,
        public string $startDate,
        public string $endDate,
        public int $defenderId,
        public int $goalkeeperId,
    )
    {
    }

}
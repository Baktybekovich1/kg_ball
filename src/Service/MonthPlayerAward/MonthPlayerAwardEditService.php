<?php

namespace App\Service\MonthPlayerAward;

use App\Dto\MonthPlayerAward\SetMonthPlayerAwardDto;
use App\Entity\MonthPlayerAward;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\MonthPlayerAwardRepository;
use App\Repository\PlayerRepository;

class MonthPlayerAwardEditService
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly GoalRepository $goalRepository,
        private readonly AssistRepository $assistRepository,
        private readonly MonthPlayerAwardRepository $monthPlayerAwardRepository,
    )
    {
    }

    public function add(SetMonthPlayerAwardDto $dto)
    {
        $bombardierId = $this->goalRepository->findMonthBombardier($dto->startDate, $dto->endDate)['playerId'];
        $assistantId = $this->assistRepository->findMonthAssistant($dto->startDate, $dto->endDate)['playerId'];
        $theBestId = $this->playerRepository->getBestPlayersInMonth($dto->startDate, $dto->endDate)[0]['playerid'];

        $award = new MonthPlayerAward();
        $award->setName($dto->name)
            ->setBombardier($this->playerRepository->find($bombardierId))
            ->setAssistant($this->playerRepository->find($assistantId))
            ->setTheBest($this->playerRepository->find($theBestId))
            ->setDefender($this->playerRepository->find($dto->defenderId))
            ->setGoalkeeper($this->playerRepository->find($dto->goalkeeperId))
            ->setStartDate($dto->startDate)
            ->setEndDate($dto->endDate);

        return $this->monthPlayerAwardRepository->save($award);
    }

    public function edit($monthId , SetMonthPlayerAwardDto $dto): bool
    {
        $bombardierId = $this->goalRepository->findMonthBombardier($dto->startDate, $dto->endDate)['playerId'];
        $assistantId = $this->assistRepository->findMonthAssistant($dto->startDate, $dto->endDate)['playerId'];
        $theBestId = $this->playerRepository->getBestPlayersInMonth($dto->startDate, $dto->endDate)[0]['playerid'];

        $award = $this->monthPlayerAwardRepository->find($monthId);
        $award->setName($dto->name)
            ->setBombardier($this->playerRepository->find($bombardierId))
            ->setAssistant($this->playerRepository->find($assistantId))
            ->setTheBest($this->playerRepository->find($theBestId))
            ->setDefender($this->playerRepository->find($dto->defenderId))
            ->setGoalkeeper($this->playerRepository->find($dto->goalkeeperId))
            ->setStartDate($dto->startDate)
            ->setEndDate($dto->endDate);

        return $this->monthPlayerAwardRepository->save($award);
    }

    public function remove($monthId): bool
    {
        $award = $this->monthPlayerAwardRepository->find($monthId);
        return $this->monthPlayerAwardRepository->remove($award);
    }

}
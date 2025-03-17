<?php

namespace App\Service\Assist;

use App\Dto\Assist\SetAssistDto;
use App\Entity\Assist;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;

readonly class AdminAssistService
{


    public function __construct(
        private AssistRepository $assistRepository,
        private GoalRepository   $goalRepository,
        private PlayerRepository $playerRepository
    )
    {
    }

    public function add(SetAssistDto $dto): bool
    {
        $assist = new Assist();
        $player = $this->playerRepository->find($dto->playerId);
        $goal = $this->goalRepository->find($dto->goalId);
        $assist->setPlayer($player);
        $assist->setGoal($goal);
        $assist->setTeam($player->getTeam());
        $assist->setVsTeam($goal->getVsTeam());
        return $this->assistRepository->save($assist);
    }

    public function remove(int $assistId): bool
    {
        $assist = $this->assistRepository->find($assistId);
        return $this->assistRepository->remove($assist);
    }

    public function edit(SetAssistDto $dto, int $assistId): bool
    {
        $assist = $this->assistRepository->find($assistId);
        $player = $this->playerRepository->find($dto->playerId);
        $goal = $this->goalRepository->find($dto->goalId);
        $assist->setPlayer($player);
        $assist->setGoal($goal);
        $assist->setTeam($player->getTeam());
        $assist->setVsTeam($goal->getVsTeam());
        return $this->assistRepository->save($assist);
    }
}
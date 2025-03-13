<?php

namespace App\Service\Goal;

use App\Controller\MyAdmin\Goal\GoalController;
use App\Dto\Goal\SetGoalDto;
use App\Entity\Goal;
use App\Repository\GameRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use App\Repository\TypeOfGoalRepository;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Admin api for Goal')]
readonly class AdminGoalService
{
    public function __construct(
        private GameRepository       $gameRepository,
        private TeamRepository       $teamRepository,
        private GoalRepository       $goalRepository,
        private PlayerRepository     $playerRepository,
        private TypeOfGoalRepository $typeOfGoalRepository
    )
    {
    }

    public function add(SetGoalDto $dto): bool
    {
        $goal = new Goal();
        $goal->setPlayer($this->playerRepository->find($dto->playerId));
        $goal->setGame($this->gameRepository->find($dto->gameId));
        $goal->setTeam($this->teamRepository->find($dto->teamId));
        $goal->setVsTeam($this->teamRepository->find($dto->vsTeamId));
        $goal->setTypeOfGoal($this->typeOfGoalRepository->find($dto->typeOfGoalId));
        return $this->goalRepository->save($goal);
    }

    public function remove(int $goalId): bool
    {
        $goal = $this->goalRepository->find($goalId);
        return $this->goalRepository->remove($goal);
    }

    public function edit(SetGoalDto $dto, int $goalId): bool
    {
        $goal = $this->goalRepository->find($goalId);
        $goal->setPlayer($this->playerRepository->find($dto->playerId));
        $goal->setGame($this->gameRepository->find($dto->gameId));
        $goal->setTeam($this->teamRepository->find($dto->teamId));
        $goal->setVsTeam($this->teamRepository->find($dto->vsTeamId));
        $goal->setTypeOfGoal($this->typeOfGoalRepository->find($dto->typeOfGoalId));
        return $this->goalRepository->save($goal);
    }

}
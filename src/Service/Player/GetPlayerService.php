<?php

namespace App\Service\Player;

use App\Dto\Player\GetPlayerG_A_TeamDto;
use App\Dto\Player\GetPlayerGoalAndAssist;
use App\Dto\Player\GetPlayerListDto;
use App\Dto\Player\GetPlayerPersonalCardDto;
use App\Dto\Player\GetPlayerStatisticDto;
use App\Entity\Player;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TypeOfGoalRepository;

class GetPlayerService
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly GoalRepository   $goalRepository,
        private readonly AssistRepository $assistRepository
    )
    {
    }

    public function GetPlayersPersonalCard($id): GetPlayerPersonalCardDto
    {
        $player = $this->playerRepository->find($id);

        return new GetPlayerPersonalCardDto(
            $player->getId(),
            $player->getName() . ' ' . $player->getSurname(),
            $player->getBirthday(),
            $player->getPosition(),
            $player->getTeam()->getId(),
            $player->getTeam()->getTitle(),
        );
    }

    public function getPlayersList(): array
    {
        return array_map(
            fn(Player $player) => new GetPlayerListDto(
                $player->getId(),
                $player->getName() . ' ' . $player->getSurname(),
                $player->getPosition(),
                $player->getTeam()->getId(),
                $player->getTeam()->getTitle()
            ),
            $this->playerRepository->findAll()
        );
    }

    public function getPlayerStatistic($id): GetPlayerStatisticDto
    {

        return new GetPlayerStatisticDto(
            $this->goalRepository->getPlayerGoalQuantity($id),
            $this->goalRepository->getPlayerGoalQuantity($id) - $this->goalRepository->getPlayerGoalTypeQuantity($id, 3),
            $this->goalRepository->getPlayerGoalTypeQuantity($id, 3),
            $this->assistRepository->getPlayerAssistQuantity($id)
        );
    }

    public function getBestPlayers(): array
    {
        $players = $this->playerRepository->findAll();
        $result = [];
        foreach ($players as $player) {
            $result[] = new GetPlayerG_A_TeamDto(
                $player->getId(),
                $player->getName() . ' ' . $player->getSurname(),
                $player->getTeam()->getTitle(),
                $this->goalRepository->getPlayerGoalQuantity($player->getId()),
                $this->assistRepository->getPlayerAssistQuantity($player->getId())
            );
        }
        return $result;

    }
}
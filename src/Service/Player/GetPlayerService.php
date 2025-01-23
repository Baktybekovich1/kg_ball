<?php

namespace App\Service\Player;

use App\Dto\Player\GetPlayerListDto;
use App\Dto\Player\GetPlayerPersonalCardDto;
use App\Dto\Player\GetPlayerStatisticDto;
use App\Repository\PlayerRepository;

class GetPlayerService
{
    public function __construct(
        private readonly PlayerRepository $playerRepository
    )
    {
    }

    public function GetPlayersPersonalCard($id): array
    {
        $player = $this->playerRepository->find($id);
        $personalCard = [];

        $personalCard[$player->getId()] = new GetPlayerPersonalCardDto(
            $player->getId(),
            $player->getName() . ' ' . $player->getSurname(),
            $player->getBirthday(),
            $player->getPosition(),
            $player->getTeam()->getId(),
            $player->getTeam()->getTitle(),
        );

        return $personalCard;
    }

    public function getPlayersList(): array
    {
        $players = $this->playerRepository->findAll();
        $playersList = [];
        foreach ($players as $player) {
            $playersList[$player->getId()] = new GetPlayerListDto(
                $player->getId(),
                $player->getName() . ' ' . $player->getSurname(),
                $player->getPosition(),
                $player->getTeam()->getId(),
                $player->getTeam()->getTitle(),
            );
        }

        return $playersList;
    }

    public function getPlayerStatistic($id)
    {
//        $player = $this->playerRepository->find($id);
//        $playerStatistic = [];
////        $playerStatistic[$player->getId()] = new GetPlayerStatisticDto(
////
////        )Надо это доделать!!!
        
    }
}
<?php

namespace App\Service\Player;

use App\Class\Transfer;
use App\Dto\Player\EditPlayerDto;
use App\Dto\Player\SetPlayerDto;
use App\Dto\Player\TransferDto;
use App\Entity\Player;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;

readonly class AdminPlayerService
{
    public function __construct(
        private PlayerRepository $playerRepository,
        private TeamRepository   $teamRepository
    )
    {
    }

    public function setPlayer(int $teamId, string $name, string $surname, string $birthday, string $position, $img): bool
    {
        $player = new Player();
        $player
            ->setTeam($this->teamRepository->find($teamId))
            ->setName($name)
            ->setSurname($surname)
            ->setBirthday($birthday)
            ->setPosition($position)
            ->setImg($img);
        return $this->playerRepository->save($player);
    }

    public function removePlayer($playerId): bool
    {
        return $this->playerRepository->remove($this->playerRepository->find($playerId));
    }

    public function editPlayer(EditPlayerDto $dto, int $id): bool
    {
        $player = $this->playerRepository->find($id);
        $player->setName($dto->name)
            ->setSurname($dto->surname)
            ->setBirthday($dto->birthday)
            ->setPosition($dto->position)
            ->setImg($dto->img);
        $this->playerRepository->save($player);
        return true;
    }

    public function transfer(TransferDto $dto): bool
    {
        $player = $this->playerRepository->find($dto->playerId);
        $player->setTeam($this->teamRepository->find($dto->teamId));
        return $this->playerRepository->save($player);
    }
}
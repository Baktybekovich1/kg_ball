<?php

namespace App\Service\Tourney;

use App\Dto\Player\GetPlayerGoalAndAssist;
use App\Dto\Player\GetPlayerNameAndAssistsDto;
use App\Dto\Player\GetPlayerNameAndGoalsDto;
use App\Dto\Team\GetTeamGoalsAndAssistsDto;
use App\Dto\Team\GetTeamInfoDto;
use App\Dto\Tourney\GetTourneyReviewDto;
use App\Repository\AssistRepository;
use App\Repository\GoalRepository;
use App\Repository\PlayerRepository;
use App\Repository\TourneyRepository;

readonly class GetTourneyService
{
    public function __construct(
        private TourneyRepository $tourneyRepository, private GoalRepository $goalRepository, private AssistRepository $assistRepository, private PlayerRepository $playerRepository
    )
    {
    }

    public function getTourneyReview(int $tourneyId): GetTourneyReviewDto
    {
        $tourney = $this->tourneyRepository->find($tourneyId);
        return new GetTourneyReviewDto(
            $tourney->getId(),
            $tourney->getTeamsSum(),
            count($tourney->getGames()),
            new GetTeamGoalsAndAssistsDto(
                $tourney->getTourneyTeamPrizes()->getFirstPosition()->getId(),
                $tourney->getTourneyTeamPrizes()->getFirstPosition()->getTitle(),
                $this->goalRepository->getTeamGoalQuantityInTourney($tourney->getTourneyTeamPrizes()->getFirstPosition()->getId(), $tourney->getId()),
                $this->assistRepository->getTeamAssistQuantityInTourney($tourney->getTourneyTeamPrizes()->getFirstPosition()->getId(), $tourney->getId())
            ),
            new GetTeamGoalsAndAssistsDto(
                $tourney->getTourneyTeamPrizes()->getSecondPosition()->getId(),
                $tourney->getTourneyTeamPrizes()->getSecondPosition()->getTitle(),
                $this->goalRepository->getTeamGoalQuantityInTourney($tourney->getTourneyTeamPrizes()->getSecondPosition()->getId(), $tourney->getId()),
                $this->assistRepository->getTeamAssistQuantityInTourney($tourney->getTourneyTeamPrizes()->getSecondPosition()->getId(), $tourney->getId())
            ),
            new GetTeamGoalsAndAssistsDto(
                $tourney->getTourneyTeamPrizes()->getThirdPosition()->getId(),
                $tourney->getTourneyTeamPrizes()->getThirdPosition()->getTitle(),
                $this->goalRepository->getTeamGoalQuantityInTourney($tourney->getTourneyTeamPrizes()->getThirdPosition()->getId(), $tourney->getId()),
                $this->assistRepository->getTeamAssistQuantityInTourney($tourney->getTourneyTeamPrizes()->getThirdPosition()->getId(), $tourney->getId())
            ),
            new GetPlayerNameAndGoalsDto(
                $this->playerRepository->getTourneyBombardier($tourney->getId())->getId(),
                $this->playerRepository->getTourneyBombardier($tourney->getId())->getName(),
                $this->goalRepository->getPlayerGoalQuantityInTourney($this->playerRepository->getTourneyBombardier($tourney->getId())->getId(), $tourney->getId())
            ),
            new GetPlayerNameAndAssistsDto(
                $this->playerRepository->getTourneyAssistant($tourney->getId())->getId(),
                $this->playerRepository->getTourneyAssistant($tourney->getId())->getName(),
                $this->assistRepository->getPlayerAssistQuantityInTourney($this->playerRepository->getTourneyAssistant($tourney->getId())->getId(), $tourney->getId())
            ),
            $this->goalRepository->getAllGoalsQuantityInTourney($tourney->getId()),
            $this->assistRepository->getAllAssistsQuantityInTourney($tourney->getId())
        );
    }

    public function getBestPlayers(int $tourney_id): ?array
    {
        $players = $this->playerRepository->findAll();
        $result = [];
        foreach ($players as $player) {
            $goals = $this->goalRepository->getPlayerGoalQuantityInTourney($player->getId(), $tourney_id);
            $assists = $this->assistRepository->getPlayerAssistQuantityInTourney($player->getId(), $tourney_id);
            if ($goals > 0 || $assists > 0) {
                $result[] = new GetPlayerGoalAndAssist(
                    $player->getId(),
                    $player->getName(),
                    $goals,
                    $assists,
                    $player->getImg()
                );
            }
        }
        return $result;

    }

    public function getWinner(int $tourney_id): GetTeamInfoDto
    {
        $tourney = $this->tourneyRepository->find($tourney_id);
        $winner = $tourney->getTourneyTeamPrizes()->getFirstPosition();
        return new GetTeamInfoDto(
            $winner->getId(),
            $winner->getTitle(),
            $winner->getLogo()
        );
    }
}
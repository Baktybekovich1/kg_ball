<?php

namespace App\Service\Game;

use App\Dto\Game\GetGameGoalsDto;
use App\Dto\Game\GetGameScoresDto;
use App\Dto\Goal\GetGoalInfoDto;
use App\Dto\Player\GetPlayerNameAndGoals;
use App\Repository\AssistRepository;
use App\Repository\GameRepository;
use App\Repository\GoalRepository;

readonly class GetGameService
{
    public function __construct(private GameRepository $gameRepository, private GoalRepository $goalRepository, private AssistRepository $assistRepository)
    {
    }

    public function getGameScores(int $id): getGameScoresDto
    {
        $game = $this->gameRepository->find($id);
        return new GetGameScoresDto(
            $game->getId(),
            $game->getWinnerTeam()->getId(),
            $game->getWinnerTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getWinnerTeam()->getId(), $game->getId()),
            $game->getLoserTeam()->getId(),
            $game->getLoserTeam()->getTitle(),
            $this->goalRepository->getTeamGoalInGameQuantity($game->getLoserTeam()->getId(), $game->getId())

        );
    }

    public function getGameGoals(int $id): getGameGoalsDto
    {
        $game = $this->gameRepository->find($id);

        return new GetGameGoalsDto(
            $this->goals($game->getWinnerTeam()->getGoals()),
            $this->goals($game->getLoserTeam()->getGoals())
        );

    }

    public function goals($go)
    {
        $goals = [];
        foreach ($go as $goal) {
            $assist = $goal->getAssist();
            if ($goal->getAssist()) {
                $goals[] = new GetGoalInfoDto(
                    $goal->getId(),
                    new GetPlayerNameAndGoals(
                        $goal->getPlayer()->getId(),
                        $goal->getPlayer()->getName(),
                    ),
                    new GetPlayerNameAndGoals(
                        $goal->getAssist()->getPlayer()->getId(),
                        $goal->getAssist()->getPlayer()->getName()
                    )
                );
            } else {
                $goals[] = new GetGoalInfoDto(
                    $goal->getId(),
                    new GetPlayerNameAndGoals(
                        $goal->getPlayer()->getId(),
                        $goal->getPlayer()->getName(),
                    )

                );
            }
        }
        return $goals;

    }

}
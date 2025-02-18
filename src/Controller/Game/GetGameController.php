<?php

namespace App\Controller\Game;

use App\Service\Game\GetGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Get api for Game')]
class GetGameController extends AbstractController
{
    public function __construct(private readonly GetGameService $getGameService)
    {
    }

    #[OA\Get(description: '
    gameId: int,
    winnerTeamId: int,
    winnerTeamTitle: str,
    winnerTeamScore: int,
    loserTeamId: int,
    loserTeamTitle: str,
    loserTeamScore: int
    ')]
    #[Route('/scores/{id}', name: 'app_game_scores', methods: ['GET'])]
    public function game_scores(Request $request): JsonResponse
    {
        return $this->json($this->getGameService->getGameScores($request->get('id')));
    }

    #[Route('/goals/{id}', name: 'app_game_goals', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        return $this->json($this->getGameService->getGameGoals($request->get('id')));
    }

}
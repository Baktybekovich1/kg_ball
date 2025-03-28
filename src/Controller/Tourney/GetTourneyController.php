<?php

namespace App\Controller\Tourney;

use App\Service\Tourney\GetTourneyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Get api for Tourney')]
class GetTourneyController extends AbstractController
{
    public function __construct(private readonly GetTourneyService $getTourneyService,
    )
    {
    }

    #[Route('/review/{id}', name: 'app_tourney_review', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getTourneyReview($request->get('id')));
    }

    #[Route('/best_players/{id}', name: 'app_tourney_best_players', methods: ['GET'])]
    public function best_players(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getBestPlayers($request->get('id')));
    }

    #[Route('/winner/{id}',name: 'app_tourney_winner', methods: ['GET'])]
    public function winner(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getWinner($request->get('id')));
        
    }

    #[Route(path: '/prizes/{tourneyId}', name: 'app_tourney_prizes', methods: ['GET'])]
    public function prizes(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getPrizes($request->get('id')));
    }
}
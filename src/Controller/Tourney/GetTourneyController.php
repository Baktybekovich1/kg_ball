<?php

namespace App\Controller\Tourney;

use App\Service\Tourney\GetTourneyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class GetTourneyController extends AbstractController
{
    public function __construct(private readonly GetTourneyService $getTourneyService,
                                )
    {
    }

    #[Route('/review/{id}', name: 'app_tourney_review')]
    public function index(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getTourneyReview($request->get('id')));
    }

    #[Route('/best_players/{id}', name: 'app_tourney_best_players')]
    public function best_players(Request $request): JsonResponse
    {
        return $this->json($this->getTourneyService->getBestPlayers($request->get('id')));
    }

}
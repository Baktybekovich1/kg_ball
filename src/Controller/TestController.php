<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'Test api`s')]
class TestController extends AbstractController
{

    public function __construct(private TeamRepository $teamRepository)
    {
    }
    
    #[Route(path: '/test', name: 'test', methods: ['GET'])]
    public function test(): JsonResponse
    {
        return $this->json($this->teamRepository->findTeamPointsInMonth(1,'2025-02-01','2025-06-01'));
    }

}
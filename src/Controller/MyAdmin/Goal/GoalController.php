<?php

namespace App\Controller\MyAdmin\Goal;

use App\Dto\Game\SetGameDto;
use App\Dto\Goal\SetGoalDto;
use App\Service\Goal\AdminGoalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class GoalController extends AbstractController
{
    public function __construct(
        private readonly AdminGoalService $service
    )
    {
    }

    #[Route(path: '/add', name: 'app_admin_goal_add', methods: ['POST'])]
    public function add(#[MapRequestPayload] SetGoalDto $dto): JsonResponse
    {
        return $this->json($this->service->add($dto));
    }

    #[Route(path: '/remove/{gameId}', name: 'app_admin_goal_remove', methods: ['DELETE'])]
    public function remove(Request $request): JsonResponse
    {
        return $this->json($this->service->remove($request->get('gameId')));
    }

    #[Route(path: '/edit/{gameId}', name: 'app_admin_goal_edit', methods: ['PATCH'])]
    public function edit(#[MapRequestPayload] SetGoalDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->service->edit($dto, $request->get('gameId')));
    }
}
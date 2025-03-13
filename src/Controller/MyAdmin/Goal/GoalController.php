<?php

namespace App\Controller\MyAdmin\Goal;

use App\Dto\Goal\SetGoalDto;
use App\Service\Goal\AdminGoalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

}
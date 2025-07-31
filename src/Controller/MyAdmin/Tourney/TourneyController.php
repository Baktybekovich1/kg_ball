<?php

namespace App\Controller\MyAdmin\Tourney;

use App\Dto\Team\EditTeamDto;
use App\Dto\Team\GetTeamTitleLogoDto;
use App\Dto\Tourney\SetTourneyDto;
use App\Dto\Tourney\FinishedDto;
use App\Service\Tourney\AdminTourneyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
#[OA\Tag(name: 'Admin api for Tourney')]
class TourneyController extends AbstractController
{
    public function __construct(
        private readonly AdminTourneyService $adminTourneyService
    )
    {
    }

    #[Route('/add', name: 'app_tourney_add', methods: ['POST'])]
    public function setNewTeam(#[MapRequestPayload] SetTourneyDto $dto): JsonResponse
    {
        return $this->json($this->adminTourneyService->setTourney($dto));
    }

    #[Route(path: '/remove/{id}', name: 'app_admin_tourney_remove', methods: ['DELETE'])]
    public function admin_team_remove(Request $request): JsonResponse
    {
        return $this->json($this->adminTourneyService->removeTourney($request->get('id')));
    }

    #[Route(path: '/edit/{id}', name: 'app_admin_tourney_edit', methods: ['PATCH'])]
    public function admin_team_edit(#[MapRequestPayload] SetTourneyDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->adminTourneyService->editTourney($dto, $request->get('id')));
    }

    #[Route(path: '/finished/{id}', name: 'app_admin_tourney_finished', methods: ['GET'])]
    public function admin_finished( Request $request): JsonResponse
    {
        return $this->json($this->adminTourneyService->finishedTourney($request->get('id')));
    }

    #[Route(path: '/finished/edit/{id}', name: 'app_admin_tourney_finished_edit', methods: ['PATCH'])]
    public function admin_tourney_finished_edit(#[MapRequestPayload] FinishedDto $dto, Request $request): JsonResponse
    {
        return $this->json($this->adminTourneyService->editFinishedTourney($dto->finished, $request->get('id')));
    }


}
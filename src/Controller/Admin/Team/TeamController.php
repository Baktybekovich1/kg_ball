<?php

namespace App\Controller\Admin\Team;

use App\Dto\Team\GetTeamTitleLogoDto;
use App\Service\Team\AdminTeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class TeamController extends AbstractController
{


    public function __construct(
        private readonly AdminTeamService $adminTeamService
    )
    {
    }

    #[Route('/team/add', name: 'app_team_add', methods: ['POST'])]
    public function setNewTeam(#[MapRequestPayload] GetTeamTitleLogoDto $dto): JsonResponse
    {
        return $this->json($this->adminTeamService->setTeam($dto->title, $dto->logo));
    }

    #[Route(path: '/team/remove/{id}', name: 'app_admin_team_remove', methods: ['DELETE'])]
    public function admin_team_remove(Request $request): JsonResponse
    {
        return $this->json($this->adminTeamService->removeTeam($request->get('id')));

    }

}
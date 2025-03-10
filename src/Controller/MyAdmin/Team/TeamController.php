<?php

namespace App\Controller\MyAdmin\Team;

use App\Dto\Team\EditTeamDto;
use App\Dto\Team\GetTeamTitleLogoDto;
use App\Service\Team\AdminTeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

use OpenApi\Attributes as OA;
use Symfony\Component\Routing\Attribute\Route;

#[OA\Tag(name: 'Admin api for Team')]
class TeamController extends AbstractController
{


    public function __construct(
        private readonly AdminTeamService $adminTeamService
    )
    {
    }

    #[Route('/add', name: 'app_team_add', methods: ['POST'])]
    public function setNewTeam(#[MapRequestPayload] GetTeamTitleLogoDto $dto): JsonResponse
    {
        return $this->json($this->adminTeamService->setTeam($dto->title, $dto->logo));
    }

    #[Route(path: '/remove/{id}', name: 'app_admin_team_remove', methods: ['DELETE'])]
    public function admin_team_remove(Request $request): JsonResponse
    {
        return $this->json($this->adminTeamService->removeTeam($request->get('id')));
    }

    #[Route(path: '/edit', name: 'app_admin_team_edit', methods: ['PATCH'])]
    public function admin_team_edit(#[MapRequestPayload] EditTeamDto $dto): JsonResponse
    {
        return $this->json($this->adminTeamService->editTeam($dto));
    }
}
<?php

namespace App\Controller\Team;

use App\Dto\Team\GetTeamTitleLogoDto;
use App\Service\Team\SetTeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class SetTeamController extends AbstractController
{


    public function __construct(
        private readonly SetTeamService $setTeamService
    )
    {
    }

    #[Route('/add', name: 'app_team_add', methods: ['POST'])]
    public function setNewTeam(#[MapRequestPayload] GetTeamTitleLogoDto $dto): JsonResponse
    {
        return $this->json($this->setTeamService->setTeam($dto->title, $dto->logo));
    }
}
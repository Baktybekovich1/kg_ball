<?php

namespace App\Controller;

use App\Classes\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): JsonResponse
    {
        $player = new Player("Aizatbek", 'Aitbaev', 19);
        //Создаём обьект на основе класса Player

        return $this->json([
            $player->name
        ]);
    }
}

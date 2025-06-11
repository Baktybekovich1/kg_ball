<?php

namespace App\Controller\Admin;

use App\Entity\Assist;
use App\Entity\Game;
use App\Entity\Goal;
use App\Entity\Liga;
use App\Entity\Player;
use App\Entity\Team;
use App\Entity\TestApi;
use App\Entity\Tourney;
use App\Entity\TourneyTeamPrizes;
use App\Entity\TypeOfGoal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin', methods: ['GET'])]
    public function index(): Response
    {


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(GameCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Type Of Goal', 'fas fa-tv', TypeOfGoal::class);
        yield MenuItem::linkToCrud('Liga', 'fas fa-shield', Liga::class);
        yield MenuItem::linkToCrud('Team', 'fas fa-shield', Team::class);
        yield MenuItem::linkToCrud('Player', 'fas fa-user', Player::class);
        yield MenuItem::linkToCrud('Tourney', 'fas fa-medal', Tourney::class);
        yield MenuItem::linkToCrud('Tourney Team Prizes (Position)', 'fas fa-medal', TourneyTeamPrizes::class);
        yield MenuItem::linkToCrud('Game', 'fas fa-clock', Game::class);
        yield MenuItem::linkToCrud('Goal', 'fas fa-clock', Goal::class);
        yield MenuItem::linkToCrud('Assist', 'fas fa-clock', Assist::class);
        yield MenuItem::linkToCrud('Test Api', 'fas fa-clock', TestApi::class);
    }
}

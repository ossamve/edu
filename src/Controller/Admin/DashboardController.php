<?php

namespace App\Controller\Admin;

use App\Entity\Assignment;
use App\Entity\Courses;
use App\Entity\Room;
use App\Entity\Student;
use App\Entity\Teacher;
use App\Entity\TeachingAssignment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(TeacherCrudController::class)->generateUrl());

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

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
            ->setTitle('Edu');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Professeurs', 'fa fa-user-md', Teacher::class);
        yield MenuItem::linkToCrud('Etudiants', 'fa fa-users', Student::class);
        yield MenuItem::linkToCrud('Cours', 'fa fa-book', Courses::class);
        yield MenuItem::linkToCrud('Classes', 'fa fa-book', Room::class);
        yield MenuItem::linkToCrud('Programmes', 'fa fa-book', TeachingAssignment::class);
        yield MenuItem::linkToCrud('Documents', 'fa fa-book', Assignment::class);
    }
}

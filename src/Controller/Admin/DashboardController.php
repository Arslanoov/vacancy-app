<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Vacancy\Request;
use App\Entity\Vacancy\Vacancy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

final class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Тестовое приложение');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Главная', 'fa fa-home');
        yield MenuItem::linkToCrud('Вакансии', 'icon class', Vacancy::class);
        yield MenuItem::linkToCrud('Отклики', 'icon class', Request::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return UserMenu::new()
            ->displayUserName()
            ->displayUserAvatar()
            ->setName(method_exists($user, '__toString') ? (string) $user : $user->getUsername())
            ->setAvatarUrl(null)
            ->setMenuItems([]);
    }
}

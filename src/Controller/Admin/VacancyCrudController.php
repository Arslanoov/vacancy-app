<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Vacancy\Vacancy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

final class VacancyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vacancy::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('description'),
            TextField::new('image')
        ];
    }
}

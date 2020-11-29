<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Vacancy\Request;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

final class VacancyRequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Request::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('fullName'),
            TextField::new('birthdayDate'),
            TextField::new('gender'),
            TextField::new('phone'),
            TextField::new('cvDescription'),
            UrlField::new('cvFile')
        ];
    }
}

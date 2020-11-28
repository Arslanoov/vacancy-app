<?php

declare(strict_types=1);

namespace Test\Unit\Vacancy;

use App\Entity\Vacancy\Vacancy;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $vacancy = Vacancy::new(
            $name = 'Грузчик',
            $description = 'Описание',
            $image = 'path'
        );

        $this->assertNotEmpty($vacancy->getId());
        $this->assertEquals($name, $vacancy->getName());
        $this->assertEquals($description, $vacancy->getDescription());
        $this->assertEquals($image, $vacancy->getImage());
    }
}

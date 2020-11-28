<?php

declare(strict_types=1);

namespace Test\Unit\Vacancy;

use App\Entity\Vacancy\Request;
use App\Entity\Vacancy\Vacancy;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testRequest(): void
    {
        $request = Request::new(
            $vacancy = Vacancy::new('Name'),
            $fullName = 'Full name',
            $birthdayDate = new DateTimeImmutable(),
            $gender = 'Male',
            $phone = '+79123456789',
            $cvDesc = 'desc',
            $cvFile = 'path'
        );

        $this->assertNotEmpty($request->getId());
        $this->assertNotEmpty($request->getBirthdayDate());
        $this->assertEquals($vacancy, $request->getVacancy());
        $this->assertEquals($birthdayDate, $request->getBirthdayDate());
        $this->assertEquals($gender, $request->getGender());
        $this->assertEquals($phone, $request->getPhone());
        $this->assertEquals($cvDesc, $request->getCvDescription());
        $this->assertEquals($cvFile, $request->getCvFile());
    }
}

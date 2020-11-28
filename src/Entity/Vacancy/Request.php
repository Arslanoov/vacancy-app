<?php

declare(strict_types=1);

namespace App\Entity\Vacancy;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Request
 * @package App\Entity\Vacancy
 * @ORM\Entity()
 * @ORM\Table(name="vacancy_requests")
 */
final class Request
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private string $id;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private DateTimeImmutable $createdAt;
    /**
     * @var Vacancy
     * @ORM\ManyToOne(targetEntity="Vacancy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vacancy_id", referencedColumnName="id")
     * })
     */
    private Vacancy $vacancy;
    /**
     * @var string
     * @ORM\Column(type="string", name="full_name")
     */
    private string $fullName;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", name="birthday_date")
     */
    private DateTimeImmutable $birthdayDate;
    /**
     * @var string
     * @ORM\Column(type="string", length=8)
     */
    private string $gender;
    /**
     * @var string
     * @ORM\Column(type="string", name="phone", length=15)
     */
    private string $phone;
    /**
     * @var string|null
     * @ORM\Column(type="string", name="cv_description", nullable=true)
     */
    private ?string $cvDescription;
    /**
     * @var string|null
     * @ORM\Column(type="string", name="cv_file", nullable=true)
     */
    private ?string $cvFile;

    private function __construct(
        string $id,
        DateTimeImmutable $createdAt,
        Vacancy $vacancy,
        string $fullName,
        DateTimeImmutable $birthdayDate,
        string $gender,
        string $phone,
        ?string $cvDescription,
        ?string $cvFile
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->vacancy = $vacancy;
        $this->fullName = $fullName;
        $this->birthdayDate = $birthdayDate;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->cvDescription = $cvDescription;
        $this->cvFile = $cvFile;
    }

    public static function new(
        Vacancy $vacancy,
        string $fullName,
        DateTimeImmutable $birthdayDate,
        string $gender,
        string $phone,
        ?string $cvDescription = null,
        ?string $cvFile = null
    ): self {
        return new self(
            Uuid::uuid4()->toString(),
            new DateTimeImmutable(),
            $vacancy,
            $fullName,
            $birthdayDate,
            $gender,
            $phone,
            $cvDescription,
            $cvFile
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getVacancy(): Vacancy
    {
        return $this->vacancy;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getBirthdayDate(): DateTimeImmutable
    {
        return $this->birthdayDate;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getCvDescription(): ?string
    {
        return $this->cvDescription;
    }

    public function getCvFile(): ?string
    {
        return $this->cvFile;
    }
}

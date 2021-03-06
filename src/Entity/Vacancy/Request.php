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
    private $id;
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
    private $fullName;
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", name="birthday_date")
     */
    private DateTimeImmutable $birthdayDate;
    /**
     * @var string
     * @ORM\Column(type="string", length=8)
     */
    private $gender;
    /**
     * @var string
     * @ORM\Column(type="string", name="phone", length=15)
     */
    private $phone;
    /**
     * @var string|null
     * @ORM\Column(type="string", name="cv_description", nullable=true)
     */
    private $cvDescription;
    /**
     * @var string|null
     * @ORM\Column(type="string", name="cv_file", nullable=true)
     */
    private $cvFile;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->createdAt = new DateTimeImmutable();
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

    public function setVacancy(Vacancy $vacancy): self
    {
        $this->vacancy = $vacancy;
        return $this;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function setBirthdayDate(DateTimeImmutable $birthdayDate): self
    {
        $this->birthdayDate = $birthdayDate;
        return $this;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function setCvDescription(?string $cvDescription): self
    {
        $this->cvDescription = $cvDescription;
        return $this;
    }

    public function setCvFile(?string $cvFile): self
    {
        $this->cvFile = $cvFile;
        return $this;
    }
}

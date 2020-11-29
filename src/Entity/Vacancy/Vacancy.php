<?php

declare(strict_types=1);

namespace App\Entity\Vacancy;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Vacancy
 * @package App\Entity\Vacancy
 * @ORM\Entity()
 * @ORM\Table(name="vacancies")
 */
final class Vacancy
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}

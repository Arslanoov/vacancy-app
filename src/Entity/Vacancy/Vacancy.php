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
    private string $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $name;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $description;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $image;

    public function __construct(string $id, string $name, ?string $description, ?string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public static function new(string $name, ?string $description = null, ?string $image = null): self
    {
        return new self(Uuid::uuid4()->toString(), $name, $description, $image);
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
}

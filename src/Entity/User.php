<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity()
 */
final class User implements UserInterface
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
    private string $username;
    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private ?string $password;

    public function __construct(string $id, string $username, ?string $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function signUp(string $username, ?string $password = null): self
    {
        return new self(Uuid::uuid4()->toString(), $username, $password);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function eraseCredentials() {}

    public function getSalt() {}
}

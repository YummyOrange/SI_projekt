<?php

namespace App\Entity;

use App\Repository\AnonUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnonUserRepository::class)]
class AnonUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $anon_user_email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnonUserEmail(): ?string
    {
        return $this->anon_user_email;
    }

    public function setAnonUserEmail(string $anon_user_email): self
    {
        $this->anon_user_email = $anon_user_email;

        return $this;
    }
}

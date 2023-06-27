<?php

namespace App\Entity;

use App\Repository\BlockadeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlockadeRepository::class)]
class Blockade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $blocked_until = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlockedUntil(): ?\DateTimeInterface
    {
        return $this->blocked_until;
    }

    public function setBlockedUntil(\DateTimeInterface $blocked_until): self
    {
        $this->blocked_until = $blocked_until;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address_in = null;

    #[ORM\Column(length: 191)]
    private ?string $address_out = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $add_date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?AnonUser $anon_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressIn(): ?string
    {
        return $this->address_in;
    }

    public function setAddressIn(string $address_in): self
    {
        $this->address_in = $address_in;

        return $this;
    }

    public function getAddressOut(): ?string
    {
        return $this->address_out;
    }

    public function setAddressOut(string $address_out): self
    {
        $this->address_out = $address_out;

        return $this;
    }

    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->add_date;
    }

    public function setAddDate(\DateTimeInterface $add_date): self
    {
        $this->add_date = $add_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user_id = $user;

        return $this;
    }

    public function getAnonUser(): ?AnonUser
    {
        return $this->anon_user;
    }

    public function setAnonUser(?AnonUser $anon_user): self
    {
        $this->anon_user = $anon_user;

        return $this;
    }
}

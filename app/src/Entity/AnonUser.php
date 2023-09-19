<?php

/**Entity AnonUser*/

namespace App\Entity;

use App\Repository\AnonUserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Anon User.
 */
#[ORM\Entity(repositoryClass: AnonUserRepository::class)]
class AnonUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $anonUserEmail = null;

    /**
     * Function getId.
     *
     * @return int|null Return of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Function getAnonUserEmail.
     *
     * @return string|null Return of AnonUserEmail
     */
    public function getAnonUserEmail(): ?string
    {
        return $this->anonUserEmail;
    }

    /**
     * Set Anon User Email.
     *
     * @param string $anonUserEmail Anon user email
     *
     * @return $this Entity
     */
    public function setAnonUserEmail(string $anonUserEmail): self
    {
        $this->anonUserEmail = $anonUserEmail;

        return $this;
    }
}

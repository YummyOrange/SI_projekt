<?php

/**Entity Address*/

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Address.
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $addressIn = null;

    #[ORM\Column(length: 191, unique: true)]
    private ?string $addressOut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $addDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    /**
     * AnonUser.
     *
     * @var ArrayCollection<int, AnonUser>
     */
    #[Assert\Valid]
    #[ORM\ManyToOne(targetEntity: AnonUser::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinTable(name: 'address_anonUser')]
    private $anonUser;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'address')]
    private Collection $tags;

    #[ORM\Column]
    private ?int $clickCounter = null;

    /**
     *Constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * Function get Id.
     *
     * @return int|null Return Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Function Get Address In.
     *
     * @return string|null Return Address In
     */
    public function getAddressIn(): ?string
    {
        return $this->addressIn;
    }

    /**
     * Function Set Address In.
     *
     * @param string $addressIn New Address In
     *
     * @return $this Return this
     */
    public function setAddressIn(string $addressIn): self
    {
        $this->addressIn = $addressIn;

        return $this;
    }

    /**
     * Function get Address Out.
     *
     * @return string|null Return address out
     */
    public function getAddressOut(): ?string
    {
        return $this->addressOut;
    }

    /**
     * Function Set Address Out.
     *
     * @param string $addressOut New Address Out
     *
     * @return $this Return entity
     */
    public function setAddressOut(string $addressOut): self
    {
        $this->addressOut = $addressOut;

        return $this;
    }

    /**
     * Function get Add Date.
     *
     * @return \DateTimeImmutable|null Return addDate
     */
    public function getAddDate(): ?\DateTimeInterface
    {
        return $this->addDate;
    }

    /**
     * Function Set Add Date.
     *
     * @param \DateTimeInterface $addDate New Add Date
     *
     * @return $this Return Entity
     */
    public function setAddDate(\DateTimeInterface $addDate): self
    {
        $this->addDate = $addDate;

        return $this;
    }

    /**
     * Function Get User.
     *
     * @return User|null Return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Function Set User.
     *
     * @param User|null $user New User
     *
     * @return $this Return Entity
     */
    public function setUser(?User $user): self
    {
        $this->userId = $user;

        return $this;
    }

    /**
     * Function get Anon User.
     *
     * @return AnonUser|null Return AnonUser
     */
    public function getAnonUser(): ?AnonUser
    {
        return $this->anonUser;
    }

    /**
     * Function Set Anon User.
     *
     * @param AnonUser|null $anonUser Anon User
     *
     * @return $this Return Entity
     */
    public function setAnonUser(?AnonUser $anonUser): self
    {
        $this->anonUser = $anonUser;

        return $this;
    }

    /**
     * @return Collection<int, Tag> Return Tags
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * Function Add Tag.
     *
     * @param Tag $tag New Tag
     *
     * @return $this Return Entity
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addAddress($this);
        }

        return $this;
    }

    /**
     * Function Remove Tag.
     *
     * @param Tag $tag Tag To Remove
     *
     * @return $this Return entity
     */
    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeAddress($this);
        }

        return $this;
    }

    /**
     * Function get Click Counter.
     *
     * @return int|null Return ClickCounter
     */
    public function getClickCounter(): ?int
    {
        return $this->clickCounter;
    }

    /**
     * Function Set Click Counter.
     *
     * @param int $clickCounter New Number
     *
     * @return $this Return Entity
     */
    public function setClickCounter(int $clickCounter): self
    {
        $this->clickCounter = $clickCounter;

        return $this;
    }
}

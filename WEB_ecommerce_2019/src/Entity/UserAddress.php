<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAddressRepository")
 */
class UserAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user", "userAddress"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("userAddress")
     */
    private $address1;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("userAddress")
     */
    private $address2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="address")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="CASCADE")
     * @Groups("userAddress")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

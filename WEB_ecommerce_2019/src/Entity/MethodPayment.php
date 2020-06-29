<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MethodPaymentRepository")
 */
class MethodPayment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user", "methodPayment", "methodPaymentType"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="methodPayments")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="CASCADE")
     * @Groups("methodPayment")
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("methodPayment")
     */
    private $information;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MethodPaymentType", inversedBy="methodPayments")
     * @Groups("methodPayment")
     */
    private $methodPaymentType;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethodPaymentType()
    {
        return $this->methodPaymentType;
    }

    /**
     * @param mixed $methodPaymentType
     */
    public function setMethodPaymentType($methodPaymentType)
    {
        $this->methodPaymentType = $methodPaymentType;
    }
}

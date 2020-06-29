<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MethodPaymentTypeRepository")
 */
class MethodPaymentType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"methodPayment", "methodPaymentType"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("methodPaymentType")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MethodPayment", mappedBy="methodPaymentType")
     * @Groups("methodPaymentType")
     */
    private $methodPayments;

    public function __construct()
    {
        $this->methodPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|MethodPayment[]
     */
    public function getMethodPayments(): Collection
    {
        return $this->methodPayments;
    }

    public function addMethodPayment(MethodPayment $methodPayment): self
    {
        if (!$this->methodPayments->contains($methodPayment)) {
            $this->methodPayments[] = $methodPayment;
            $methodPayment->setMethodPaymentType($this);
        }

        return $this;
    }

    public function removeMethodPayment(MethodPayment $methodPayment): self
    {
        if ($this->methodPayments->contains($methodPayment)) {
            $this->methodPayments->removeElement($methodPayment);
            // set the owning side to null (unless already changed)
            if ($methodPayment->getMethodPaymentType() === $this) {
                $methodPayment->setMethodPaymentType();
            }
        }

        return $this;
    }


}

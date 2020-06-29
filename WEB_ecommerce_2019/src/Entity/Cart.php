<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user", "cart", "cartArticle"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("cart")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("cart")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="carts")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="CASCADE")
     * @Groups("cart")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CartArticle", mappedBy="cart", cascade={"persist"})
     * @Groups("cart")
     */
    private $cartArticle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     * @Groups("cart")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->cartArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

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

    /**
     * @return Collection|CartArticle[]
     */
    public function getCartArticle(): Collection
    {
        return $this->cartArticle;
    }

    public function addCartArticle(CartArticle $cartArticle): self
    {
        if (!$this->cartArticle->contains($cartArticle)) {
            $this->cartArticle[] = $cartArticle;
            $cartArticle->setCart($this);
        }

        return $this;
    }

    public function removeCartArticle(CartArticle $cartArticle): self
    {
        if ($this->cartArticle->contains($cartArticle)) {
            $this->cartArticle->removeElement($cartArticle);
            // set the owning side to null (unless already changed)
            if ($cartArticle->getCart() === $this) {
                $cartArticle->setCart(null);
            }
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

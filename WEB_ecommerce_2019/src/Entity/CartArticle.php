<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CartArticleRepository")
 */
class CartArticle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"cart", "cartArticle"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cart", "cartArticle"})
     *
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cart", inversedBy="cartArticle")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cartArticle"})
     */
    private $cart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cart", "cartArticle"})
     */
    private $article;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}

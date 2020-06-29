<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E6612469DE2", columns={"category_id"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({
     *     "category", "brand", "article", "comment", "discount", "articleType", "articlePurpose", "compatibility",
     *     "cartArticle", "cart", "searchable"
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Groups({"article", "cart", "brand", "searchable"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=0, nullable=false)
     * @Groups({"article", "brand", "cart"})
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="decimal", precision=4, scale=0, nullable=false)
     * @Groups({"article", "brand"})
     */
    private $weight = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", nullable=false)
     * @Groups("article")
     */
    private $height = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", nullable=false)
     * @Groups("article")
     */
    private $width = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="length", type="integer", nullable=false)
     * @Groups("article")
     */
    private $length = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     * @Groups({"article", "cart", "brand"})
     */
    private $stock = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=4, scale=0, nullable=false)
     * @Groups({"article", "brand", "cart"})
     */
    private $price = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="imageMain", type="string", length=255, nullable=true)
     * @Groups({"article", "cart", "brand", "searchable"})
     */
    private $imageMain;

    /**
     * @var string
     *
     * @ORM\Column(name="image1", type="string", length=255, nullable=true)
     * @Groups("article")
     */
    private $image1;

    /**
     * @var string
     *
     * @ORM\Column(name="image2", type="string", length=255, nullable=true)
     * @Groups("article")
     */
    private $image2;

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", length=255, nullable=true)
     * @Groups("article")
     */
    private $image3;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Groups({"article", "brand"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Groups("article")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"article", "brand", "searchable"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compatibility", inversedBy="articles")
     * @Groups("article")
     */
    private $compatibility;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleType", inversedBy="articles")
     * @Groups({"article", "brand", "searchable"})
     */
    private $articleType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticlePurpose", inversedBy="articles")
     * @Groups({"article", "brand"})
     */
    private $articlePurpose;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Brand", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"article", "searchable"})
     */
    private $brand;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Discount", mappedBy="article")
     * @Groups("article")
     */
    private $discounts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article", orphanRemoval=true)
     * @Groups("article")
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->discounts = new ArrayCollection();
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     */
    public function setWeight(string $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price)
    {
        $this->price = $price;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return string
     */
    public function getImageMain()
    {
        return $this->imageMain;
    }

    /**
     * @param string $imageMain
     */
    public function setImageMain(string $imageMain)
    {
        $this->imageMain = $imageMain;
    }

    /**
     * @return string
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param string $image1
     */
    public function setImage1(string $image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return string
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param string $image2
     */
    public function setImage2(string $image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return string
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param string $image3
     */
    public function setImage3(string $image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCompatibility(): ?Compatibility
    {
        return $this->compatibility;
    }

    public function setCompatibility(?Compatibility $compatibility): self
    {
        $this->compatibility = $compatibility;

        return $this;
    }

    public function getArticleType(): ?ArticleType
    {
        return $this->articleType;
    }

    public function setArticleType(?ArticleType $articleType): self
    {
        $this->articleType = $articleType;

        return $this;
    }

    public function getArticlePurpose(): ?ArticlePurpose
    {
        return $this->articlePurpose;
    }

    public function setArticlePurpose(?ArticlePurpose $articlePurpose): self
    {
        $this->articlePurpose = $articlePurpose;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Discount[]
     */
    public function getDiscounts(): Collection
    {
        return $this->discounts;
    }

    public function addDiscount(Discount $discount): self
    {
        if (!$this->discounts->contains($discount)) {
            $this->discounts[] = $discount;
            $discount->setArticleId($this);
        }

        return $this;
    }

    public function removeDiscount(Discount $discount): self
    {
        if ($this->discounts->contains($discount)) {
            $this->discounts->removeElement($discount);
            // set the owning side to null (unless already changed)
            if ($discount->getArticleId() === $this) {
                $discount->setArticleId(null);
            }
        }

        return $this;
    }
}

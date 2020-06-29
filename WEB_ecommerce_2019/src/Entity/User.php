<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields = {"email"}, message = "L'email que vous avez avez indique est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"discount", "user", "userAddress", "methodPayment", "cart"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="The email '{{value}}' is not a valid email.")
     * @Groups("user")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Votre mot de passe n'est pas identique")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("user")
     */
    private $reset_password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", nullable=false)
     * @Groups("user")
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     * @Groups("user")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     * @Groups("user")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Discount", mappedBy="user")
     * @Groups("user")
     */
    private $discounts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MethodPayment", mappedBy="user")
     * @Groups("user")
     */
    private $methodPayments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserAddress", mappedBy="user")
     * @Groups("user")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cart", mappedBy="user")
     * @Groups("user")
     */
    private $carts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerId;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $roles;


    public function __construct()
    {
        $this->methodPayments = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getRoles()
    {
        if (empty($this->roles))
            return ['ROLE_USER'];

        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return Collection|Discount[]
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    public function addDiscount(Discount $discount)
    {
        if (!$this->discounts->contains($discount)) {
            $this->discounts[] = $discount;
            $discount->setUserId($this);
        }

        return $this;
    }

    public function removeDiscount(Discount $discount)
    {
        if ($this->discounts->contains($discount)) {
            $this->discounts->removeElement($discount);
            // set the owning side to null (unless already changed)
            if ($discount->getUserId() === $this) {
                $discount->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MethodPayment[]
     */
    public function getMethodPayments()
    {
        return $this->methodPayments;
    }

    public function addMethodPayment(MethodPayment $methodPayment)
    {
        if (!$this->methodPayments->contains($methodPayment)) {
            $this->methodPayments[] = $methodPayment;
            $methodPayment->setUserId($this);
        }

        return $this;
    }

    public function removeMethodPayment(MethodPayment $methodPayment)
    {
        if ($this->methodPayments->contains($methodPayment)) {
            $this->methodPayments->removeElement($methodPayment);
            // set the owning side to null (unless already changed)
            if ($methodPayment->getUserId() === $this) {
                $methodPayment->setUserId(null);
            }
        }

        return $this;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
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

    /**
     * @return Collection|UserAddress[]
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function addAddress(UserAddress $address)
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(UserAddress $address)
    {
        if ($this->address->contains($address)) {
            $this->address->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts()
    {
        return $this->carts;
    }

    public function addCart(Cart $cart)
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setUser($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart)
    {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getUser() === $this) {
                $cart->setUser(null);
            }
        }

        return $this;
    }

    public function getAge()
    {
        $dateInterval = $this->birthdate->diff(new \DateTime());

        return $dateInterval->y;
    }

    /**
     * @return mixed
     */
    public function getResetPassword()
    {
        return $this->reset_password;
    }

    /**
     * @param mixed $reset_password
     */
    public function setResetPassword($reset_password): void
    {
        $this->reset_password = $reset_password;
    }

    public function getStripeToken(): ?string
    {
        return $this->stripe_token;
    }

    public function setStripeToken(?string $stripe_token): self
    {
        $this->stripe_token = $stripe_token;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(?string $customerId): self
    {
        $this->customerId = $customerId;

        return $this;
    }
}

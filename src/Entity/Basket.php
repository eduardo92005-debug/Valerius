<?php

namespace App\Entity;

use App\Repository\BasketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BasketRepository::class)
 */
class Basket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $link_to_user;

    /**
     * @ORM\OneToMany(targetEntity=Cars::class, mappedBy="basket")
     */
    private $add_cars;

    public function __construct()
    {
        $this->add_cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkToUser(): ?User
    {
        return $this->link_to_user;
    }

    public function setLinkToUser(?User $link_to_user): self
    {
        $this->link_to_user = $link_to_user;

        return $this;
    }

    /**
     * @return Collection<int, Cars>
     */
    public function getAddCars(): Collection
    {
        return $this->add_cars;
    }

    public function addAddCar(Cars $addCar): self
    {
        if (!$this->add_cars->contains($addCar)) {
            $this->add_cars[] = $addCar;
            $addCar->setBasket($this);
        }

        return $this;
    }

    public function removeAddCar(Cars $addCar): self
    {
        if ($this->add_cars->removeElement($addCar)) {
            // set the owning side to null (unless already changed)
            if ($addCar->getBasket() === $this) {
                $addCar->setBasket(null);
            }
        }

        return $this;
    }
}

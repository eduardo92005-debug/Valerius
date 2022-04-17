<?php

namespace App\Entity;

use App\Repository\RepairRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RepairRepository::class)
 */
class Repair
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $confirmation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $delivery_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $problem;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConfirmationDate(): ?\DateTimeImmutable
    {
        return $this->confirmation_date;
    }

    public function setConfirmationDate(\DateTimeImmutable $confirmation_date): self
    {
        $this->confirmation_date = $confirmation_date;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(\DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    public function getProblem(): ?string
    {
        return $this->problem;
    }

    public function setProblem(?string $problem): self
    {
        $this->problem = $problem;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

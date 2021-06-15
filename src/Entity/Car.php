<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 * @ApiResource
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Fuel;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=Ad::class, inversedBy="car", cascade={"persist", "remove"})
     */
    private $relation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuel(): ?string
    {
        return $this->Fuel;
    }

    public function setFuel(string $Fuel): self
    {
        $this->Fuel = $Fuel;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRelation(): ?Ad
    {
        return $this->relation;
    }

    public function setRelation(?Ad $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}

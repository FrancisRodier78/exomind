<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EstateRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=EstateRepository::class)
 * @ApiResource
 */
class Estate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=Ad::class, inversedBy="estate", cascade={"persist", "remove"})
     */
    private $relation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(int $area): self
    {
        $this->area = $area;

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

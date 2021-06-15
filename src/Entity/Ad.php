<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=AdRepository::class)
 * @ApiResource
 */
class Ad
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ads")
     */
    private $relation;

    /**
     * @ORM\OneToOne(targetEntity=Job::class, mappedBy="relation", cascade={"persist", "remove"})
     */
    private $job;

    /**
     * @ORM\OneToOne(targetEntity=Car::class, mappedBy="relation", cascade={"persist", "remove"})
     */
    private $car;

    /**
     * @ORM\OneToOne(targetEntity=Estate::class, mappedBy="relation", cascade={"persist", "remove"})
     */
    private $estate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getRelation(): ?User
    {
        return $this->relation;
    }

    public function setRelation(?User $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        // unset the owning side of the relation if necessary
        if ($job === null && $this->job !== null) {
            $this->job->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($job !== null && $job->getRelation() !== $this) {
            $job->setRelation($this);
        }

        $this->job = $job;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        // unset the owning side of the relation if necessary
        if ($car === null && $this->car !== null) {
            $this->car->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($car !== null && $car->getRelation() !== $this) {
            $car->setRelation($this);
        }

        $this->car = $car;

        return $this;
    }

    public function getEstate(): ?Estate
    {
        return $this->estate;
    }

    public function setEstate(?Estate $estate): self
    {
        // unset the owning side of the relation if necessary
        if ($estate === null && $this->estate !== null) {
            $this->estate->setRelation(null);
        }

        // set the owning side of the relation if necessary
        if ($estate !== null && $estate->getRelation() !== $this) {
            $estate->setRelation($this);
        }

        $this->estate = $estate;

        return $this;
    }
}

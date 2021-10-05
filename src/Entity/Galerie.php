<?php

namespace App\Entity;

use App\Repository\GalerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GalerieRepository::class)
 */
class Galerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageList;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="galerieId")
     */
    private $ImageRelation;

    public function __construct()
    {
        $this->ImageRelation = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageList(): ?string
    {
        return $this->imageList;
    }

    public function setImageList(string $imageList): self
    {
        $this->imageList = $imageList;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImageRelation(): Collection
    {
        return $this->ImageRelation;
    }

    public function addImageRelation(Image $imageRelation): self
    {
        if (!$this->ImageRelation->contains($imageRelation)) {
            $this->ImageRelation[] = $imageRelation;
            $imageRelation->setGalerieId($this);
        }

        return $this;
    }

    public function removeImageRelation(Image $imageRelation): self
    {
        if ($this->ImageRelation->removeElement($imageRelation)) {
            // set the owning side to null (unless already changed)
            if ($imageRelation->getGalerieId() === $this) {
                $imageRelation->setGalerieId(null);
            }
        }

        return $this;
    }
}

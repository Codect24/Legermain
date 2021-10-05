<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
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
     * @ORM\Column(type="string", length=50)
     */
    private $legend;

    /**
     * @ORM\ManyToOne(targetEntity=Galerie::class, inversedBy="ImageRelation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $galerieId;

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

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    public function getGalerieId(): ?Galerie
    {
        return $this->galerieId;
    }

    public function setGalerieId(?Galerie $galerieId): self
    {
        $this->galerieId = $galerieId;

        return $this;
    }
}

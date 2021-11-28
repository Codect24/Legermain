<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobOfferRepository::class)
 */
class JobOffer
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
     * @ORM\Column(type="string", length=100)
     */
    private $details;

    /**
     * @ORM\Column(type="smallint")
     */
    private $jobType;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\OneToMany(targetEntity=JobOfferAnswer::class, mappedBy="jobOfferID")
     */
    private $AnswerRelation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $jobStyle;

    public function __construct()
    {
        $this->AnswerRelation = new ArrayCollection();
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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getJobType(): ?int
    {
        return $this->jobType;
    }

    public function setJobType(int $jobType): self
    {
        $this->jobType = $jobType;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return Collection|JobOfferAnswer[]
     */
    public function getAnswerRelation(): Collection
    {
        return $this->AnswerRelation;
    }

    public function addAnswerRelation(JobOfferAnswer $answerRelation): self
    {
        if (!$this->AnswerRelation->contains($answerRelation)) {
            $this->AnswerRelation[] = $answerRelation;
            $answerRelation->setJobOfferID($this);
        }

        return $this;
    }

    public function removeAnswerRelation(JobOfferAnswer $answerRelation): self
    {
        if ($this->AnswerRelation->removeElement($answerRelation)) {
            // set the owning side to null (unless already changed)
            if ($answerRelation->getJobOfferID() === $this) {
                $answerRelation->setJobOfferID(null);
            }
        }

        return $this;
    }

    public function getJobStyle(): ?int
    {
        return $this->jobStyle;
    }

    public function setJobStyle(?int $jobStyle): self
    {
        $this->jobStyle = $jobStyle;

        return $this;
    }
}

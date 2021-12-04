<?php

namespace App\Entity;

use App\Repository\JobOfferAnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=JobOfferAnswerRepository::class)
 * @Vich\Uploadable
 */
class JobOfferAnswer
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
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @Vich\UploadableField(mapping="job_cv", fileNameProperty="cv")
     * @var File|null
     */
    private $cvFile;

    /**
     * @return File|null
     */
    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    /**
     * @param File|null $cvFile
     */
    public function setCvFile(?File $cvFile = null): void
    {
        $this->cvFile = $cvFile;
        if (null !== $cvFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motivationLetter;

    /**
     * @Vich\UploadableField(mapping="job_lm", fileNameProperty="motivationLetter")
     * @var File|null
     */
    private $lmFile;

    /**
     * @return File|null
     */
    public function getLmFile(): ?File
    {
        return $this->lmFile;
    }

    /**
     * @param File|null $lmFile
     */
    public function setLmFile(?File $lmFile = null): void
    {
        $this->lmFile = $lmFile;
        if (null !== $lmFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @ORM\Column(name="jobOfferState", type="integer", options={"default" : 0})
     */
    private $jobOfferState;

    /**
     * @ORM\Column(name="archivingState", type="integer", options={"default" : 0})
     */
    private $archivingState;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $jobOfferId;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobOfferId(): ?int
    {
        return $this->jobOfferId;
    }

    public function setJobOfferId(int $jobOfferId): self
    {
        $this->jobOfferId = $jobOfferId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv)
    {
        $this->cv = $cv;
        return $this;
    }

    public function getMotivationLetter(): ?string
    {
        return $this->motivationLetter;
    }

    public function setMotivationLetter(string $motivationLetter): self
    {
        $this->motivationLetter = $motivationLetter;
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

    public function getJobOfferState(): ?int
    {
        return $this->jobOfferState;
    }

    public function setJobOfferState(int $jobOfferState): self
    {
        $this->jobOfferState = $jobOfferState;

        return $this;
    }

    public function getArchivingState(): ?int
    {
        return $this->archivingState;
    }

    public function setArchivingState(int $archivingState): self
    {
        $this->archivingState = $archivingState;

        return $this;
    }

    public function getLinkCv()
    {
        return '/uploads/job/cv/'.$this->getCv();
    }

    public function getLinkLm()
    {
        return '/uploads/job/lm/'.$this->getMotivationLetter();
    }
}

<?php

namespace App\Entity;

use App\Repository\CustomerRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRequestRepository::class)
 */
class CustomerRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageList;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $requestState;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="custumerRequestRelation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?int
    {
        return $this->userId;
    }

    public function setUserID(int $userId): self
    {
        $this->userId = $userId;

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

    public function setImageList(?string $imageList): self
    {
        $this->imageList = $imageList;

        return $this;
    }

    public function getRequestState(): ?string
    {
        return $this->requestState;
    }

    public function setRequestState(string $requestState): self
    {
        $this->requestState = $requestState;

        return $this;
    }
}

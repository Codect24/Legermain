<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $moderationState;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="CommentsRelation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function setArticleId(int $articleId): self
    {
        $articleId->articleID = $articleId;

        return $articleId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
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

    public function getModerationState(): ?int
    {
        return $this->moderationState;
    }

    public function setModerationState(int $moderationState): self
    {
        $this->moderationState = $moderationState;

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
}

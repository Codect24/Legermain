<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageList;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="relation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="articleId")
     */
    private $CommentsRelation;

    public function __construct()
    {
        $this->CommentsRelation = new ArrayCollection();
    }

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

    public function getImageList(): ?string
    {
        return $this->imageList;
    }

    public function setImageList(?string $imageList): self
    {
        $this->imageList = $imageList;

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
     * @return Collection|Comments[]
     */
    public function getCommentsRelation(): Collection
    {
        return $this->CommentsRelation;
    }

    public function addCommentsRelation(Comments $commentsRelation): self
    {
        if (!$this->CommentsRelation->contains($commentsRelation)) {
            $this->CommentsRelation[] = $commentsRelation;
            $commentsRelation->setArticleId($this);
        }

        return $this;
    }

    public function removeCommentsRelation(Comments $commentsRelation): self
    {
        if ($this->CommentsRelation->removeElement($commentsRelation)) {
            // set the owning side to null (unless already changed)
            if ($commentsRelation->getArticleId() === $this) {
                $commentsRelation->setArticleId(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="userId")
     */
    private $relation;

    /**
     * @ORM\OneToMany(targetEntity=CustomerRequest::class, mappedBy="userId")
     */
    private $custumerRequestRelation;

    /**
     * @ORM\OneToMany(targetEntity=Realisation::class, mappedBy="userID")
     */
    private $categorie;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->custumerRequestRelation = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Article[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Article $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setUserId($this);
        }

        return $this;
    }

    public function removeRelation(Article $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getUserId() === $this) {
                $relation->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CustomerRequest[]
     */
    public function getCustumerRequestRelation(): Collection
    {
        return $this->custumerRequestRelation;
    }

    public function addCustumerRequestRelation(CustomerRequest $custumerRequestRelation): self
    {
        if (!$this->custumerRequestRelation->contains($custumerRequestRelation)) {
            $this->custumerRequestRelation[] = $custumerRequestRelation;
            $custumerRequestRelation->setUserId($this);
        }

        return $this;
    }

    public function removeCustumerRequestRelation(CustomerRequest $custumerRequestRelation): self
    {
        if ($this->custumerRequestRelation->removeElement($custumerRequestRelation)) {
            // set the owning side to null (unless already changed)
            if ($custumerRequestRelation->getUserId() === $this) {
                $custumerRequestRelation->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Realisation[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Realisation $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setUserID($this);
        }

        return $this;
    }

    public function removeCategorie(Realisation $categorie): self
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getUserID() === $this) {
                $categorie->setUserID(null);
            }
        }

        return $this;
    }
}

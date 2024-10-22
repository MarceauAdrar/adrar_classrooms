<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $username = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    // #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: UtilisateursChapitres::class, orphanRemoval: true)]
    // private Collection $utilisateursChapitres;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $googleId = null;

    /**
     * @var Collection<int, UserChapter>
     */
    #[ORM\OneToMany(targetEntity: UserChapter::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userChapters;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Opinion $opinion = null;

    public function __construct()
    {
        $this->image = 'default_avatar.png';
        // $this->utilisateursChapitres = new ArrayCollection();
        $this->userChapters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    // /**
    //  * @return Collection<int, UtilisateursChapitres>
    //  */
    // public function getUtilisateursChapitres(): Collection
    // {
    //     return $this->utilisateursChapitres;
    // }

    // public function addUtilisateursChapitre(UtilisateursChapitres $utilisateursChapitre): self
    // {
    //     if (!$this->utilisateursChapitres->contains($utilisateursChapitre)) {
    //         $this->utilisateursChapitres->add($utilisateursChapitre);
    //         $utilisateursChapitre->setUtilisateur($this);
    //     }

    //     return $this;
    // }

    // public function removeUtilisateursChapitre(UtilisateursChapitres $utilisateursChapitre): self
    // {
    //     if ($this->utilisateursChapitres->removeElement($utilisateursChapitre)) {
    //         // set the owning side to null (unless already changed)
    //         if ($utilisateursChapitre->getUtilisateur() === $this) {
    //             $utilisateursChapitre->setUtilisateur(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): self
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * @return Collection<int, UserChapter>
     */
    public function getUserChapters(): Collection
    {
        return $this->userChapters;
    }

    public function addUserChapter(UserChapter $userChapter): static
    {
        if (!$this->userChapters->contains($userChapter)) {
            $this->userChapters->add($userChapter);
            $userChapter->setUser($this);
        }

        return $this;
    }

    public function removeUserChapter(UserChapter $userChapter): static
    {
        if ($this->userChapters->removeElement($userChapter)) {
            // set the owning side to null (unless already changed)
            if ($userChapter->getUser() === $this) {
                $userChapter->setUser(null);
            }
        }

        return $this;
    }

    public function getOpinion(): ?Opinion
    {
        return $this->opinion;
    }

    public function setOpinion(Opinion $opinion): static
    {
        // set the owning side of the relation if necessary
        if ($opinion->getUser() !== $this) {
            $opinion->setUser($this);
        }

        $this->opinion = $opinion;

        return $this;
    }
}

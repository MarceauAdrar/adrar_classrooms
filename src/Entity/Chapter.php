<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    /**
     * @var Collection<int, UserChapter>
     */
    #[ORM\OneToMany(targetEntity: UserChapter::class, mappedBy: 'chapter', orphanRemoval: true)]
    private Collection $userChapters;

    public function __construct()
    {
        $this->userChapters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): static
    {
        $this->course = $course;

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
            $userChapter->setChapter($this);
        }

        return $this;
    }

    public function removeUserChapter(UserChapter $userChapter): static
    {
        if ($this->userChapters->removeElement($userChapter)) {
            // set the owning side to null (unless already changed)
            if ($userChapter->getChapter() === $this) {
                $userChapter->setChapter(null);
            }
        }

        return $this;
    }
}

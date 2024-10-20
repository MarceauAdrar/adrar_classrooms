<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 6)]
    private ?string $couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    /**
     * @var Collection<int, VehiculeConcessionnaire>
     */
    #[ORM\OneToMany(targetEntity: VehiculeConcessionnaire::class, mappedBy: 'vehicule')]
    private Collection $vehiculeConcessionnaires;

    public function __construct()
    {
        $this->vehiculeConcessionnaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return "#" . $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection<int, VehiculeConcessionnaire>
     */
    public function getVehiculeConcessionnaires(): Collection
    {
        return $this->vehiculeConcessionnaires;
    }

    public function addVehiculeConcessionnaire(VehiculeConcessionnaire $vehiculeConcessionnaire): static
    {
        if (!$this->vehiculeConcessionnaires->contains($vehiculeConcessionnaire)) {
            $this->vehiculeConcessionnaires->add($vehiculeConcessionnaire);
            $vehiculeConcessionnaire->setVehicule($this);
        }

        return $this;
    }

    public function removeVehiculeConcessionnaire(VehiculeConcessionnaire $vehiculeConcessionnaire): static
    {
        if ($this->vehiculeConcessionnaires->removeElement($vehiculeConcessionnaire)) {
            // set the owning side to null (unless already changed)
            if ($vehiculeConcessionnaire->getVehicule() === $this) {
                $vehiculeConcessionnaire->setVehicule(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ConcessionnaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcessionnaireRepository::class)]
class Concessionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $groupe = null;

    #[ORM\Column]
    private ?int $adresse_numero = null;

    #[ORM\Column(length: 150)]
    private ?string $adresse_rue = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_ville = null;

    #[ORM\Column(length: 5)]
    private ?string $adresse_cp = null;

    /**
     * @var Collection<int, VehiculeConcessionnaire>
     */
    #[ORM\OneToMany(targetEntity: VehiculeConcessionnaire::class, mappedBy: 'concessionnaire')]
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

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): static
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getAdresseNumero(): ?int
    {
        return $this->adresse_numero;
    }

    public function setAdresseNumero(int $adresse_numero): static
    {
        $this->adresse_numero = $adresse_numero;

        return $this;
    }

    public function getAdresseRue(): ?string
    {
        return $this->adresse_rue;
    }

    public function setAdresseRue(string $adresse_rue): static
    {
        $this->adresse_rue = $adresse_rue;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->adresse_ville;
    }

    public function setAdresseVille(string $adresse_ville): static
    {
        $this->adresse_ville = $adresse_ville;

        return $this;
    }

    public function getAdresseCp(): ?string
    {
        return $this->adresse_cp;
    }

    public function setAdresseCp(string $adresse_cp): static
    {
        $this->adresse_cp = $adresse_cp;

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
            $vehiculeConcessionnaire->setConcessionnaire($this);
        }

        return $this;
    }

    public function removeVehiculeConcessionnaire(VehiculeConcessionnaire $vehiculeConcessionnaire): static
    {
        if ($this->vehiculeConcessionnaires->removeElement($vehiculeConcessionnaire)) {
            // set the owning side to null (unless already changed)
            if ($vehiculeConcessionnaire->getConcessionnaire() === $this) {
                $vehiculeConcessionnaire->setConcessionnaire(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\VehiculeConcessionnaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeConcessionnaireRepository::class)]
class VehiculeConcessionnaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vehiculeConcessionnaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Concessionnaire $concessionnaire = null;

    #[ORM\ManyToOne(inversedBy: 'vehiculeConcessionnaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehicule $vehicule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConcessionnaire(): ?Concessionnaire
    {
        return $this->concessionnaire;
    }

    public function setConcessionnaire(?Concessionnaire $concessionnaire): static
    {
        $this->concessionnaire = $concessionnaire;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): static
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}

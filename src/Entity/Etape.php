<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
#[ORM\Table(name: 'etape')]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idEtape')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $ordre = null;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    #[ORM\JoinColumn(name: 'idExposition', referencedColumnName: 'idExposition', nullable: false)]
    private ?Exposition $exposition = null;

    #[ORM\Column(nullable: true)]
    private ?bool $estComplete = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): static
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getExposition(): ?Exposition
    {
        return $this->exposition;
    }

    public function setExposition(?Exposition $exposition): static
    {
        $this->exposition = $exposition;

        return $this;
    }

    public function isEstComplete(): ?bool
    {
        return $this->estComplete;
    }

    public function setEstComplete(?bool $estComplete): static
    {
        $this->estComplete = $estComplete;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TraductionArtisteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraductionArtisteRepository::class)]
class TraductionArtiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $traductionTexte = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $urlAcces = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(inversedBy: 'traductionartistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?artiste $idArtiste = null;

    #[ORM\ManyToOne(inversedBy: 'traductionartistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?langue $idLangue = null;

    #[ORM\ManyToOne(inversedBy: 'traductionartistes')]
    private ?employe $idEmploye = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraductionTexte(): ?string
    {
        return $this->traductionTexte;
    }

    public function setTraductionTexte(?string $traductionTexte): static
    {
        $this->traductionTexte = $traductionTexte;

        return $this;
    }

    public function getUrlAcces(): ?string
    {
        return $this->urlAcces;
    }

    public function setUrlAcces(?string $urlAcces): static
    {
        $this->urlAcces = $urlAcces;

        return $this;
    }

    public function getDateAjout(): ?\DateTime
    {
        return $this->dateAjout;
    }

    public function setDateAjout(?\DateTime $dateAjout): static
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getIdArtiste(): ?artiste
    {
        return $this->idArtiste;
    }

    public function setIdArtiste(?artiste $idArtiste): static
    {
        $this->idArtiste = $idArtiste;

        return $this;
    }

    public function getIdLangue(): ?langue
    {
        return $this->idLangue;
    }

    public function setIdLangue(?langue $idLangue): static
    {
        $this->idLangue = $idLangue;

        return $this;
    }

    public function getIdEmploye(): ?employe
    {
        return $this->idEmploye;
    }

    public function setIdEmploye(?employe $idEmploye): static
    {
        $this->idEmploye = $idEmploye;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TraductionArtisteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraductionArtisteRepository::class)]
#[ORM\Table(name: 'traductionartiste')]
class TraductionArtiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idTraductionArtiste')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $traductionTexte = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $urlAcces = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'traductionArtistes')]
    #[ORM\JoinColumn(name: 'idArtiste', referencedColumnName: 'idArtiste', nullable: false)]
    private ?Artiste $artiste = null;

    #[ORM\ManyToOne(targetEntity: Langue::class, inversedBy: 'traductionArtistes')]
    #[ORM\JoinColumn(name: 'idLangue', referencedColumnName: 'idLangue', nullable: false)]
    private ?Langue $langue = null;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'traductionArtistes')]
    #[ORM\JoinColumn(name: 'idEmploye', referencedColumnName: 'idEmploye', nullable: true)]
    private ?Employe $employe = null;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

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

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;
        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): static
    {
        $this->langue = $langue;
        return $this;
    }

    public function getEmploye(): ?Employe
    {
        return $this->employe;
    }

    public function setEmploye(?Employe $employe): static
    {
        $this->employe = $employe;
        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TraductionContenuEnrichiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraductionContenuEnrichiRepository::class)]
#[ORM\Table(name: 'traductioncontenuenrichi')]
class TraductionContenuEnrichi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idTraductionContenu')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $traductionTexte = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $urlAcces = null;

    #[ORM\Column(options: ['default' => 1])]
    private ?int $ordreAffichage = 1;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(targetEntity: ContenuEnrichi::class, inversedBy: 'traductions')]
    #[ORM\JoinColumn(name: 'idContenuEnrichi', referencedColumnName: 'idContenuEnrichi', nullable: false)]
    private ?ContenuEnrichi $contenuEnrichi = null;

    #[ORM\ManyToOne(targetEntity: Langue::class, inversedBy: 'traductionContenuEnrichis')]
    #[ORM\JoinColumn(name: 'idLangue', referencedColumnName: 'idLangue', nullable: false)]
    private ?Langue $langue = null;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'traductionContenuEnrichis')]
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

    public function getOrdreAffichage(): ?int
    {
        return $this->ordreAffichage;
    }

    public function setOrdreAffichage(?int $ordreAffichage): static
    {
        $this->ordreAffichage = $ordreAffichage;
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

    public function getContenuEnrichi(): ?ContenuEnrichi
    {
        return $this->contenuEnrichi;
    }

    public function setContenuEnrichi(?ContenuEnrichi $contenuEnrichi): static
    {
        $this->contenuEnrichi = $contenuEnrichi;
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
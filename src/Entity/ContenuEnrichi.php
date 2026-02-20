<?php

namespace App\Entity;

use App\Repository\ContenuEnrichiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenuEnrichiRepository::class)]
class ContenuEnrichi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlAcces = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordreAffichage = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAjout = null;

    /**
     * @var Collection<int, TraductionContenueEnrichie>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenueEnrichie::class, mappedBy: 'idContenuEnrichi', orphanRemoval: true)]
    private Collection $traductionContenueEnrichies;

    #[ORM\ManyToOne(inversedBy: 'contenuEnrichis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?oeuvre $idOeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'contenuEnrichis')]
    private ?employe $idEmploye = null;

    public function __construct()
    {
        $this->traductionContenueEnrichies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, TraductionContenueEnrichie>
     */
    public function getTraductionContenueEnrichies(): Collection
    {
        return $this->traductionContenueEnrichies;
    }

    public function addTraductionContenueEnrichy(TraductionContenueEnrichie $traductionContenueEnrichy): static
    {
        if (!$this->traductionContenueEnrichies->contains($traductionContenueEnrichy)) {
            $this->traductionContenueEnrichies->add($traductionContenueEnrichy);
            $traductionContenueEnrichy->setIdContenuEnrichi($this);
        }

        return $this;
    }

    public function removeTraductionContenueEnrichy(TraductionContenueEnrichie $traductionContenueEnrichy): static
    {
        if ($this->traductionContenueEnrichies->removeElement($traductionContenueEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenueEnrichy->getIdContenuEnrichi() === $this) {
                $traductionContenueEnrichy->setIdContenuEnrichi(null);
            }
        }

        return $this;
    }

    public function getIdOeuvre(): ?oeuvre
    {
        return $this->idOeuvre;
    }

    public function setIdOeuvre(?oeuvre $idOeuvre): static
    {
        $this->idOeuvre = $idOeuvre;

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

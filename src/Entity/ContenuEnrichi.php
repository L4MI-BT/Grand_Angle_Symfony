<?php

namespace App\Entity;

//use App\Entity\TraductionContenuEnrichi;
use App\Repository\ContenuEnrichiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenuEnrichiRepository::class)]
#[ORM\Table(name: 'contenuenrichi', indexes: [
    new ORM\Index(name: 'idx_ordre_affichage', columns: ['ordreAffichage'])
])]
class ContenuEnrichi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idContenuEnrichi')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $urlAcces = null;

    #[ORM\Column(options: ['default' => 1])]
    private ?int $ordreAffichage = 1;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(targetEntity: Oeuvre::class, inversedBy: 'contenuEnrichis')]
    #[ORM\JoinColumn(name: 'idOeuvre', referencedColumnName: 'idOeuvre', nullable: false)]
    private ?Oeuvre $oeuvre = null;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'contenuEnrichis')]
    #[ORM\JoinColumn(name: 'idEmploye', referencedColumnName: 'idEmploye', nullable: true)]
    private ?Employe $employe = null;

    /**
     * @var Collection<int, TraductionContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenuEnrichi::class, mappedBy: 'contenuEnrichi')]
    private Collection $traductions;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
        $this->traductions = new ArrayCollection();
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

    public function getOeuvre(): ?Oeuvre
    {
        return $this->oeuvre;
    }

    public function setOeuvre(?Oeuvre $oeuvre): static
    {
        $this->oeuvre = $oeuvre;
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

    /**
     * @return Collection<int, TraductionContenuEnrichi>
     */
    public function getTraductions(): Collection
    {
        return $this->traductions;
    }

    public function addTraduction(TraductionContenuEnrichi $traduction): static
    {
        if (!$this->traductions->contains($traduction)) {
            $this->traductions->add($traduction);
            $traduction->setContenuEnrichi($this);
        }
        return $this;
    }

    public function removeTraduction(TraductionContenuEnrichi $traduction): static
    {
        if ($this->traductions->removeElement($traduction)) {
            if ($traduction->getContenuEnrichi() === $this) {
                $traduction->setContenuEnrichi(null);
            }
        }
        return $this;
    }
}
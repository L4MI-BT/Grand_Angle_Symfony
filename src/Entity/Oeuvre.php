<?php

namespace App\Entity;

use App\Entity\TraductionOeuvre;
use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
#[ORM\Table(name: 'oeuvre')]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idOeuvre')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technique = null;

    #[ORM\Column(nullable: true)]
    private ?int $anneeCreation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlQrCode = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordreVisite = null;

    #[ORM\Column(nullable: true)]
    private ?int $numeroIdentification = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $hauteurCm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $largeurCm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $profondeurCm = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLivraisonPrevue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateLivraisonReelle = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(targetEntity: Exposition::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'idExposition', referencedColumnName: 'idExposition', nullable: true)]
    private ?Exposition $exposition = null;

    #[ORM\ManyToOne(targetEntity: Emplacement::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'idEmplacement', referencedColumnName: 'idEmplacement', nullable: true)]
    private ?Emplacement $emplacement = null;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'idArtiste', referencedColumnName: 'idArtiste', nullable: false)]
    private ?Artiste $artiste = null;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(name: 'idEmploye', referencedColumnName: 'idEmploye', nullable: true)]
    private ?Employe $employe = null;

    /**
     * @var Collection<int, TraductionOeuvre>
     */
    #[ORM\OneToMany(targetEntity: TraductionOeuvre::class, mappedBy: 'oeuvre')]
    private Collection $traductions;

    /**
     * @var Collection<int, ContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: ContenuEnrichi::class, mappedBy: 'oeuvre')]
    private Collection $contenuEnrichis;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'oeuvre')]
    private Collection $consultations;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
        $this->traductions = new ArrayCollection();
        $this->contenuEnrichis = new ArrayCollection();
        $this->consultations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
        return $this;
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

    public function getTechnique(): ?string
    {
        return $this->technique;
    }

    public function setTechnique(?string $technique): static
    {
        $this->technique = $technique;
        return $this;
    }

    public function getAnneeCreation(): ?int
    {
        return $this->anneeCreation;
    }

    public function setAnneeCreation(?int $anneeCreation): static
    {
        $this->anneeCreation = $anneeCreation;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getUrlQrCode(): ?string
    {
        return $this->urlQrCode;
    }

    public function setUrlQrCode(?string $urlQrCode): static
    {
        $this->urlQrCode = $urlQrCode;
        return $this;
    }

    public function getOrdreVisite(): ?int
    {
        return $this->ordreVisite;
    }

    public function setOrdreVisite(?int $ordreVisite): static
    {
        $this->ordreVisite = $ordreVisite;
        return $this;
    }

    public function getNumeroIdentification(): ?int
    {
        return $this->numeroIdentification;
    }

    public function setNumeroIdentification(?int $numeroIdentification): static
    {
        $this->numeroIdentification = $numeroIdentification;
        return $this;
    }

    public function getHauteurCm(): ?string
    {
        return $this->hauteurCm;
    }

    public function setHauteurCm(?string $hauteurCm): static
    {
        $this->hauteurCm = $hauteurCm;
        return $this;
    }

    public function getLargeurCm(): ?string
    {
        return $this->largeurCm;
    }

    public function setLargeurCm(?string $largeurCm): static
    {
        $this->largeurCm = $largeurCm;
        return $this;
    }

    public function getProfondeurCm(): ?string
    {
        return $this->profondeurCm;
    }

    public function setProfondeurCm(?string $profondeurCm): static
    {
        $this->profondeurCm = $profondeurCm;
        return $this;
    }

    public function getDateLivraisonPrevue(): ?\DateTime
    {
        return $this->dateLivraisonPrevue;
    }

    public function setDateLivraisonPrevue(?\DateTime $dateLivraisonPrevue): static
    {
        $this->dateLivraisonPrevue = $dateLivraisonPrevue;
        return $this;
    }

    public function getDateLivraisonReelle(): ?\DateTime
    {
        return $this->dateLivraisonReelle;
    }

    public function setDateLivraisonReelle(?\DateTime $dateLivraisonReelle): static
    {
        $this->dateLivraisonReelle = $dateLivraisonReelle;
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

    public function getExposition(): ?Exposition
    {
        return $this->exposition;
    }

    public function setExposition(?Exposition $exposition): static
    {
        $this->exposition = $exposition;
        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): static
    {
        $this->emplacement = $emplacement;
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
     * @return Collection<int, TraductionOeuvre>
     */
    public function getTraductions(): Collection
    {
        return $this->traductions;
    }

    public function addTraduction(TraductionOeuvre $traduction): static
    {
        if (!$this->traductions->contains($traduction)) {
            $this->traductions->add($traduction);
            $traduction->setOeuvre($this);
        }
        return $this;
    }

    public function removeTraduction(TraductionOeuvre $traduction): static
    {
        if ($this->traductions->removeElement($traduction)) {
            if ($traduction->getOeuvre() === $this) {
                $traduction->setOeuvre(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ContenuEnrichi>
     */
    public function getContenuEnrichis(): Collection
    {
        return $this->contenuEnrichis;
    }

    public function addContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if (!$this->contenuEnrichis->contains($contenuEnrichi)) {
            $this->contenuEnrichis->add($contenuEnrichi);
            $contenuEnrichi->setOeuvre($this);
        }
        return $this;
    }

    public function removeContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if ($this->contenuEnrichis->removeElement($contenuEnrichi)) {
            if ($contenuEnrichi->getOeuvre() === $this) {
                $contenuEnrichi->setOeuvre(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): static
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations->add($consultation);
            $consultation->setOeuvre($this);
        }
        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            if ($consultation->getOeuvre() === $this) {
                $consultation->setOeuvre(null);
            }
        }
        return $this;
    }
}
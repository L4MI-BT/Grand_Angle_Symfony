<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(nullable: true)]
    private ?int $anneeCreation = null;

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

    #[ORM\Column(nullable: true)]
    private ?int $ordreVisite = null;

    #[ORM\Column(length: 500)]
    private ?string $urlQrCode = null;

    #[ORM\Column(length: 255)]
    private ?string $datetime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateAjout = null;

    /**
     * @var Collection<int, Traductionoeuvre>
     */
    #[ORM\OneToMany(targetEntity: Traductionoeuvre::class, mappedBy: 'idOeuvre')]
    private Collection $traductionoeuvres;

    #[ORM\Column(length: 255)]
    private ?string $technique = null;

    #[ORM\Column(nullable: true)]
    private ?int $numeroIdentification = null;

    #[ORM\ManyToOne(inversedBy: 'idEmplacement')]
    private ?exposition $idExposition = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    private ?emplacement $idEmplacement = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?artiste $idArtiste = null;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    private ?employe $idEmploye = null;

    /**
     * @var Collection<int, ContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: ContenuEnrichi::class, mappedBy: 'idOeuvre', orphanRemoval: true)]
    private Collection $contenuEnrichis;

    /**
     * @var Collection<int, Consultation>
     */
    #[ORM\OneToMany(targetEntity: Consultation::class, mappedBy: 'idOeuvre', orphanRemoval: true)]
    private Collection $consultations;

    public function __construct()
    {
        $this->traductionoeuvres = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getOrdreVisite(): ?int
    {
        return $this->ordreVisite;
    }

    public function setOrdreVisite(?int $ordreVisite): static
    {
        $this->ordreVisite = $ordreVisite;

        return $this;
    }

    public function getUrlQrCode(): ?string
    {
        return $this->urlQrCode;
    }

    public function setUrlQrCode(string $urlQrCode): static
    {
        $this->urlQrCode = $urlQrCode;

        return $this;
    }

    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    public function setDatetime(string $datetime): static
    {
        $this->datetime = $datetime;

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
     * @return Collection<int, Traductionoeuvre>
     */
    public function getTraductionoeuvres(): Collection
    {
        return $this->traductionoeuvres;
    }

    public function addTraductionoeuvre(Traductionoeuvre $traductionoeuvre): static
    {
        if (!$this->traductionoeuvres->contains($traductionoeuvre)) {
            $this->traductionoeuvres->add($traductionoeuvre);
            $traductionoeuvre->setIdOeuvre($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(Traductionoeuvre $traductionoeuvre): static
    {
        if ($this->traductionoeuvres->removeElement($traductionoeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionoeuvre->getIdOeuvre() === $this) {
                $traductionoeuvre->setIdOeuvre(null);
            }
        }

        return $this;
    }

    public function getTechnique(): ?string
    {
        return $this->technique;
    }

    public function setTechnique(string $technique): static
    {
        $this->technique = $technique;

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

    public function getIdExposition(): ?exposition
    {
        return $this->idExposition;
    }

    public function setIdExposition(?exposition $idExposition): static
    {
        $this->idExposition = $idExposition;

        return $this;
    }

    public function getIdEmplacement(): ?emplacement
    {
        return $this->idEmplacement;
    }

    public function setIdEmplacement(?emplacement $idEmplacement): static
    {
        $this->idEmplacement = $idEmplacement;

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

    public function getIdEmploye(): ?employe
    {
        return $this->idEmploye;
    }

    public function setIdEmploye(?employe $idEmploye): static
    {
        $this->idEmploye = $idEmploye;

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
            $contenuEnrichi->setIdOeuvre($this);
        }

        return $this;
    }

    public function removeContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if ($this->contenuEnrichis->removeElement($contenuEnrichi)) {
            // set the owning side to null (unless already changed)
            if ($contenuEnrichi->getIdOeuvre() === $this) {
                $contenuEnrichi->setIdOeuvre(null);
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
            $consultation->setIdOeuvre($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): static
    {
        if ($this->consultations->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getIdOeuvre() === $this) {
                $consultation->setIdOeuvre(null);
            }
        }

        return $this;
    }
}

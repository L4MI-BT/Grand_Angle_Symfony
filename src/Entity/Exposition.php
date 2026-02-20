<?php

namespace App\Entity;

use App\Repository\ExpositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpositionRepository::class)]
class Exposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $theme = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $horaires = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $modulePublicActif = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, TraductionExpo>
     */
    #[ORM\OneToMany(targetEntity: TraductionExpo::class, mappedBy: 'idExposition', orphanRemoval: true)]
    private Collection $traductionExpos;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'idExposition')]
    private Collection $oeuvre;

    #[ORM\ManyToOne(inversedBy: 'expositions')]
    private ?employe $idEmploye = null;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'idExposition', orphanRemoval: true)]
    private Collection $etapes;

    /**
     * @var Collection<int, Emplacement>
     */
    #[ORM\OneToMany(targetEntity: Emplacement::class, mappedBy: 'idExposition', orphanRemoval: true)]
    private Collection $emplacements;

    public function __construct()
    {
        $this->traductionExpos = new ArrayCollection();
        $this->oeuvre = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->emplacements = new ArrayCollection();
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

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(?string $horaires): static
    {
        $this->horaires = $horaires;

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

    public function getModulePublicActif(): ?int
    {
        return $this->modulePublicActif;
    }

    public function setModulePublicActif(?int $modulePublicActif): static
    {
        $this->modulePublicActif = $modulePublicActif;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, TraductionExpo>
     */
    public function getTraductionExpos(): Collection
    {
        return $this->traductionExpos;
    }

    public function addTraductionExpo(TraductionExpo $traductionExpo): static
    {
        if (!$this->traductionExpos->contains($traductionExpo)) {
            $this->traductionExpos->add($traductionExpo);
            $traductionExpo->setIdExposition($this);
        }

        return $this;
    }

    public function removeTraductionExpo(TraductionExpo $traductionExpo): static
    {
        if ($this->traductionExpos->removeElement($traductionExpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionExpo->getIdExposition() === $this) {
                $traductionExpo->setIdExposition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvre(): Collection
    {
        return $this->oeuvre;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->oeuvre->contains($oeuvre)) {
            $this->oeuvre->add($oeuvre);
            $oeuvre->setIdExposition($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvre->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getIdExposition() === $this) {
                $oeuvre->setIdExposition(null);
            }
        }

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
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): static
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
            $etape->setIdExposition($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getIdExposition() === $this) {
                $etape->setIdExposition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Emplacement>
     */
    public function getEmplacements(): Collection
    {
        return $this->emplacements;
    }

    public function addEmplacement(Emplacement $emplacement): static
    {
        if (!$this->emplacements->contains($emplacement)) {
            $this->emplacements->add($emplacement);
            $emplacement->setIdExposition($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getIdExposition() === $this) {
                $emplacement->setIdExposition(null);
            }
        }

        return $this;
    }
}

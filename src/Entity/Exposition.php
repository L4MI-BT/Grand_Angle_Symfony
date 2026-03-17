<?php

namespace App\Entity;

use App\Repository\ExpositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use SebastianBergmann\Type\Type;

#[ORM\Entity(repositoryClass: ExpositionRepository::class)]
#[ORM\Table(name: 'exposition')]
class Exposition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idExposition')]
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

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 0])]
    private ?bool $modulePublicActif = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, TraductionExpo>
     */
    #[ORM\OneToMany(targetEntity: TraductionExpo::class, mappedBy: 'exposition')]
    private Collection $traductionExpos;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'exposition')]
    private Collection $oeuvres;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'expositions')]
    #[ORM\JoinColumn(name: 'idEmploye', referencedColumnName: 'idEmploye', nullable: true)]
    private ?Employe $employe = null;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'exposition')]
    private Collection $etapes;

    /**
     * @var Collection<int, Emplacement>
     */
    #[ORM\OneToMany(targetEntity: Emplacement::class, mappedBy: 'exposition', orphanRemoval: true)]
    private Collection $emplacements;

    #[ORM\Column(nullable: true)]
    private ?int $frequentation = null;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->modulePublicActif = false;
        $this->traductionExpos = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
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

    public function getModulePublicActif(): ?bool
    {
        return $this->modulePublicActif;
    }

    public function setModulePublicActif(?bool $modulePublicActif): static
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
            $traductionExpo->setExposition($this);
        }

        return $this;
    }

    public function removeTraductionExpo(TraductionExpo $traductionExpo): static
    {
        if ($this->traductionExpos->removeElement($traductionExpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionExpo->getExposition() === $this) {
                $traductionExpo->setExposition(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setExposition($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getExposition() === $this) {
                $oeuvre->setExposition(null);
            }
        }

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
            $etape->setExposition($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getExposition() === $this) {
                $etape->setExposition(null);
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
            $emplacement->setExposition($this);
        }

        return $this;
    }

    public function removeEmplacement(Emplacement $emplacement): static
    {
        if ($this->emplacements->removeElement($emplacement)) {
            // set the owning side to null (unless already changed)
            if ($emplacement->getExposition() === $this) {
                $emplacement->setExposition(null);
            }
        }

        return $this;
    }

    public function getFrequentation(): ?int
    {
        return $this->frequentation;
    }

    public function setFrequentation(?int $frequentation): static
    {
        $this->frequentation = $frequentation;

        return $this;
    }
}

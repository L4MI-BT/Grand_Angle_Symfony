<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
#[ORM\Table(name: 'artiste')]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idArtiste')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(name: 'anneeNaissance', nullable: true)]
    private ?int $anneeNaissance = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(name: 'dateAjout', type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateAjout = null;

    #[ORM\ManyToOne(targetEntity: Employe::class, inversedBy: 'artistes')]
    #[ORM\JoinColumn(name: 'idEmploye', referencedColumnName: 'idEmploye', nullable: true)]
    private ?Employe $employe = null;

    /**
     * @var Collection<int, TraductionArtiste>
     */
    #[ORM\OneToMany(targetEntity: TraductionArtiste::class, mappedBy: 'artiste')]
    private Collection $traductionartistes;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'artiste')]
    private Collection $oeuvres;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();  // ← AJOUTÉ
        $this->traductionartistes = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAnneeNaissance(): ?int
    {
        return $this->anneeNaissance;
    }

    public function setAnneeNaissance(?int $anneeNaissance): static
    {
        $this->anneeNaissance = $anneeNaissance;

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
     * @return Collection<int, TraductionArtiste>
     */
    public function getTraductionartistes(): Collection
    {
        return $this->traductionartistes;
    }

    public function addTraductionartiste(TraductionArtiste $traductionartiste): static
    {
        if (!$this->traductionartistes->contains($traductionartiste)) {
            $this->traductionartistes->add($traductionartiste);
            $traductionartiste->setArtiste($this);
        }

        return $this;
    }

    public function removeTraductionartiste(TraductionArtiste $traductionartiste): static
    {
        if ($this->traductionartistes->removeElement($traductionartiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionartiste->getArtiste() === $this) {
                $traductionartiste->setArtiste(null);
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
            $oeuvre->setArtiste($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getArtiste() === $this) {
                $oeuvre->setArtiste(null);
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
}

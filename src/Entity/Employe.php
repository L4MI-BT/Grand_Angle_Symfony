<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 250)]
    private ?string $role = null;

    #[ORM\Column(length: 50)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $actif = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $supprime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateSuppression = null;

    /**
     * @var Collection<int, Traductionoeuvre>
     */
    #[ORM\OneToMany(targetEntity: Traductionoeuvre::class, mappedBy: 'idEmploye')]
    private Collection $traductionoeuvres;

    /**
     * @var Collection<int, Traductionexpo>
     */
    #[ORM\OneToMany(targetEntity: Traductionexpo::class, mappedBy: 'idEmploye')]
    private Collection $traductionexpos;

    /**
     * @var Collection<int, TraductionContenueEnrichie>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenueEnrichie::class, mappedBy: 'idEmploye')]
    private Collection $traductionContenueEnrichies;

    /**
     * @var Collection<int, Traductionartiste>
     */
    #[ORM\OneToMany(targetEntity: Traductionartiste::class, mappedBy: 'idEmploye')]
    private Collection $traductionartistes;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\OneToMany(targetEntity: Oeuvre::class, mappedBy: 'idEmploye')]
    private Collection $oeuvres;

    /**
     * @var Collection<int, Exposition>
     */
    #[ORM\OneToMany(targetEntity: Exposition::class, mappedBy: 'idEmploye')]
    private Collection $expositions;

    #[ORM\ManyToOne(inversedBy: 'employes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?fonction $idFonction = null;

    /**
     * @var Collection<int, ContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: ContenuEnrichi::class, mappedBy: 'idEmploye')]
    private Collection $contenuEnrichis;

    /**
     * @var Collection<int, Artiste>
     */
    #[ORM\OneToMany(targetEntity: Artiste::class, mappedBy: 'idEmploye')]
    private Collection $artistes;

    public function __construct()
    {
        $this->traductionoeuvres = new ArrayCollection();
        $this->traductionexpos = new ArrayCollection();
        $this->traductionContenueEnrichies = new ArrayCollection();
        $this->traductionartistes = new ArrayCollection();
        $this->oeuvres = new ArrayCollection();
        $this->expositions = new ArrayCollection();
        $this->contenuEnrichis = new ArrayCollection();
        $this->artistes = new ArrayCollection();
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

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getActif(): ?int
    {
        return $this->actif;
    }

    public function setActif(?int $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getSupprime(): ?int
    {
        return $this->supprime;
    }

    public function setSupprime(?int $supprime): static
    {
        $this->supprime = $supprime;

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

    public function getDateSuppression(): ?\DateTime
    {
        return $this->dateSuppression;
    }

    public function setDateSuppression(?\DateTime $dateSuppression): static
    {
        $this->dateSuppression = $dateSuppression;

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
            $traductionoeuvre->setIdEmploye($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(Traductionoeuvre $traductionoeuvre): static
    {
        if ($this->traductionoeuvres->removeElement($traductionoeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionoeuvre->getIdEmploye() === $this) {
                $traductionoeuvre->setIdEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Traductionexpo>
     */
    public function getTraductionexpos(): Collection
    {
        return $this->traductionexpos;
    }

    public function addTraductionexpo(Traductionexpo $traductionexpo): static
    {
        if (!$this->traductionexpos->contains($traductionexpo)) {
            $this->traductionexpos->add($traductionexpo);
            $traductionexpo->setIdEmploye($this);
        }

        return $this;
    }

    public function removeTraductionexpo(Traductionexpo $traductionexpo): static
    {
        if ($this->traductionexpos->removeElement($traductionexpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionexpo->getIdEmploye() === $this) {
                $traductionexpo->setIdEmploye(null);
            }
        }

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
            $traductionContenueEnrichy->setIdEmploye($this);
        }

        return $this;
    }

    public function removeTraductionContenueEnrichy(TraductionContenueEnrichie $traductionContenueEnrichy): static
    {
        if ($this->traductionContenueEnrichies->removeElement($traductionContenueEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenueEnrichy->getIdEmploye() === $this) {
                $traductionContenueEnrichy->setIdEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Traductionartiste>
     */
    public function getTraductionartistes(): Collection
    {
        return $this->traductionartistes;
    }

    public function addTraductionartiste(Traductionartiste $traductionartiste): static
    {
        if (!$this->traductionartistes->contains($traductionartiste)) {
            $this->traductionartistes->add($traductionartiste);
            $traductionartiste->setIdEmploye($this);
        }

        return $this;
    }

    public function removeTraductionartiste(Traductionartiste $traductionartiste): static
    {
        if ($this->traductionartistes->removeElement($traductionartiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionartiste->getIdEmploye() === $this) {
                $traductionartiste->setIdEmploye(null);
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
            $oeuvre->setIdEmploye($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getIdEmploye() === $this) {
                $oeuvre->setIdEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exposition>
     */
    public function getExpositions(): Collection
    {
        return $this->expositions;
    }

    public function addExposition(Exposition $exposition): static
    {
        if (!$this->expositions->contains($exposition)) {
            $this->expositions->add($exposition);
            $exposition->setIdEmploye($this);
        }

        return $this;
    }

    public function removeExposition(Exposition $exposition): static
    {
        if ($this->expositions->removeElement($exposition)) {
            // set the owning side to null (unless already changed)
            if ($exposition->getIdEmploye() === $this) {
                $exposition->setIdEmploye(null);
            }
        }

        return $this;
    }

    public function getIdFonction(): ?fonction
    {
        return $this->idFonction;
    }

    public function setIdFonction(?fonction $idFonction): static
    {
        $this->idFonction = $idFonction;

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
            $contenuEnrichi->setIdEmploye($this);
        }

        return $this;
    }

    public function removeContenuEnrichi(ContenuEnrichi $contenuEnrichi): static
    {
        if ($this->contenuEnrichis->removeElement($contenuEnrichi)) {
            // set the owning side to null (unless already changed)
            if ($contenuEnrichi->getIdEmploye() === $this) {
                $contenuEnrichi->setIdEmploye(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes->add($artiste);
            $artiste->setIdEmploye($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        if ($this->artistes->removeElement($artiste)) {
            // set the owning side to null (unless already changed)
            if ($artiste->getIdEmploye() === $this) {
                $artiste->setIdEmploye(null);
            }
        }

        return $this;
    }
}

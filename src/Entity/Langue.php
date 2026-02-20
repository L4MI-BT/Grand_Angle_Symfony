<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    /**
     * @var Collection<int, Traductionoeuvre>
     */
    #[ORM\OneToMany(targetEntity: Traductionoeuvre::class, mappedBy: 'idLangue', orphanRemoval: true)]
    private Collection $traductionoeuvres;

    /**
     * @var Collection<int, Traductionexpo>
     */
    #[ORM\OneToMany(targetEntity: Traductionexpo::class, mappedBy: 'idLangue', orphanRemoval: true)]
    private Collection $traductionexpos;

    /**
     * @var Collection<int, TraductionContenueEnrichie>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenueEnrichie::class, mappedBy: 'idLangue', orphanRemoval: true)]
    private Collection $traductionContenueEnrichies;

    /**
     * @var Collection<int, Traductionartiste>
     */
    #[ORM\OneToMany(targetEntity: Traductionartiste::class, mappedBy: 'idLangue', orphanRemoval: true)]
    private Collection $traductionartistes;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    public function __construct()
    {
        $this->traductionoeuvres = new ArrayCollection();
        $this->traductionexpos = new ArrayCollection();
        $this->traductionContenueEnrichies = new ArrayCollection();
        $this->traductionartistes = new ArrayCollection();
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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

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
            $traductionoeuvre->setIdLangue($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(Traductionoeuvre $traductionoeuvre): static
    {
        if ($this->traductionoeuvres->removeElement($traductionoeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionoeuvre->getIdLangue() === $this) {
                $traductionoeuvre->setIdLangue(null);
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
            $traductionexpo->setIdLangue($this);
        }

        return $this;
    }

    public function removeTraductionexpo(Traductionexpo $traductionexpo): static
    {
        if ($this->traductionexpos->removeElement($traductionexpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionexpo->getIdLangue() === $this) {
                $traductionexpo->setIdLangue(null);
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
            $traductionContenueEnrichy->setIdLangue($this);
        }

        return $this;
    }

    public function removeTraductionContenueEnrichy(TraductionContenueEnrichie $traductionContenueEnrichy): static
    {
        if ($this->traductionContenueEnrichies->removeElement($traductionContenueEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenueEnrichy->getIdLangue() === $this) {
                $traductionContenueEnrichy->setIdLangue(null);
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
            $traductionartiste->setIdLangue($this);
        }

        return $this;
    }

    public function removeTraductionartiste(Traductionartiste $traductionartiste): static
    {
        if ($this->traductionartistes->removeElement($traductionartiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionartiste->getIdLangue() === $this) {
                $traductionartiste->setIdLangue(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }
}

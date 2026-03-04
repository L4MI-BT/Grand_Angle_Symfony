<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LangueRepository::class)]
#[ORM\Table(name: 'langue')]
class Langue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idLangue')]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    /**
     * @var Collection<int, TraductionOeuvre>
     */
    #[ORM\OneToMany(targetEntity: TraductionOeuvre::class, mappedBy: 'langue')]
    private Collection $traductionOeuvres;

    /**
     * @var Collection<int, TraductionExpo>
     */
    #[ORM\OneToMany(targetEntity: TraductionExpo::class, mappedBy: 'langue')]
    private Collection $traductionExpos;

    /**
     * @var Collection<int, TraductionContenuEnrichi>
     */
    #[ORM\OneToMany(targetEntity: TraductionContenuEnrichi::class, mappedBy: 'langue')]
    private Collection $traductionContenuEnrichis;

    /**
     * @var Collection<int, TraductionArtiste>
     */
    #[ORM\OneToMany(targetEntity: TraductionArtiste::class, mappedBy: 'langue')]
    private Collection $traductionArtistes;

    #[ORM\Column(length: 5)]
    private ?string $code = null;

    public function __construct()
    {
        $this->traductionOeuvres = new ArrayCollection();
        $this->traductionExpos = new ArrayCollection();
        $this->traductionContenuEnrichis = new ArrayCollection();
        $this->traductionArtistes = new ArrayCollection();
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
     * @return Collection<int, TraductionOeuvre>
     */
    public function getTraductionOeuvres(): Collection
    {
        return $this->traductionOeuvres;
    }

    public function addTraductionOeuvre(TraductionOeuvre $traductionOeuvre): static
    {
        if (!$this->traductionOeuvres->contains($traductionOeuvre)) {
            $this->traductionOeuvres->add($traductionOeuvre);
            $traductionOeuvre->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionoeuvre(TraductionOeuvre $traductionOeuvre): static
    {
        if ($this->traductionOeuvres->removeElement($traductionOeuvre)) {
            // set the owning side to null (unless already changed)
            if ($traductionOeuvre->getLangue() === $this) {
                $traductionOeuvre->setLangue(null);
            }
        }

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
            $traductionExpo->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionExpo(TraductionExpo $traductionExpo): static
    {
        if ($this->traductionExpos->removeElement($traductionExpo)) {
            // set the owning side to null (unless already changed)
            if ($traductionExpo->getLangue() === $this) {
                $traductionExpo->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionContenueEnrichie>
     */
    public function getTraductionContenuEnrichis(): Collection
    {
        return $this->traductionContenuEnrichis;
    }

    public function addTraductionContenueEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if (!$this->traductionContenuEnrichis->contains($traductionContenuEnrichy)) {
            $this->traductionContenuEnrichis->add($traductionContenuEnrichy);
            $traductionContenuEnrichy->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionContenueEnrichy(TraductionContenuEnrichi $traductionContenuEnrichy): static
    {
        if ($this->traductionContenuEnrichis->removeElement($traductionContenuEnrichy)) {
            // set the owning side to null (unless already changed)
            if ($traductionContenuEnrichy->getLangue() === $this) {
                $traductionContenuEnrichy->setLangue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraductionArtiste>
     */
    public function getTraductionArtistes(): Collection
    {
        return $this->traductionArtistes;
    }

    public function addTraductionArtiste(TraductionArtiste $traductionArtiste): static
    {
        if (!$this->traductionArtistes->contains($traductionArtiste)) {
            $this->traductionArtistes->add($traductionArtiste);
            $traductionArtiste->setLangue($this);
        }

        return $this;
    }

    public function removeTraductionArtiste(TraductionArtiste $traductionArtiste): static
    {
        if ($this->traductionArtistes->removeElement($traductionArtiste)) {
            // set the owning side to null (unless already changed)
            if ($traductionArtiste->getLangue() === $this) {
                $traductionArtiste->setLangue(null);
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

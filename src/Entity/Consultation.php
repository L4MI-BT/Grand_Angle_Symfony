<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
#[ORM\Table(name: 'consultation')]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idConsultation')]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateConsultation = null;

    #[ORM\ManyToOne(targetEntity: Oeuvre::class, inversedBy: 'consultations')]
    #[ORM\JoinColumn(name: 'idOeuvre', referencedColumnName: 'idOeuvre', nullable: false)]
    private ?Oeuvre $oeuvre = null;

    public function __construct()
    {
        $this->dateConsultation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateConsultation(): ?\DateTime
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation(?\DateTime $dateConsultation): static
    {
        $this->dateConsultation = $dateConsultation;
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
}
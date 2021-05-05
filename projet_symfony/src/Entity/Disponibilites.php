<?php

namespace App\Entity;

use App\Repository\DisponibilitesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisponibilitesRepository::class)
 */
class Disponibilites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idDispo;

    /**
     * @ORM\Column(type="string")
     * @var \DateTime
     */
    private $dateRdv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut = 'libre';

    public function getIdDispo(): ?int
    {
        return $this->idDispo;
    }

    public function setIdDispo(int $idDispo): self
    {
        $this->idDispo = $idDispo;

        return $this;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->dateRdv;
    }

    /**
     * @return \DateTime
     */
    public function setDateRdv(\DateTime $dateRdv): self
    {
        $this->dateRdv = $dateRdv;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function toArray()
    {
        return ['dateRdv' => $this->dateRdv, 'statut' => $this->statut];
    }
}

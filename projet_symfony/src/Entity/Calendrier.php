<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CalendrierRepository;
use Doctrine\ORM\Mapping as ORM;

use function Amp\Iterator\toArray;

/**
 * @ORM\Entity(repositoryClass=CalendrierRepository::class)
 */
class Calendrier
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @var \DateTime
     */
    private $dateRdv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matiere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut = 'libre';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="calendrier")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $id = null;

    /**
     * @return \DateTime
     */
    public function getDateRdv(): ?\DateTime
    {
        return \DateTime::createFromFormat("Y-m-d|", $this->dateRdv);
    }

    /**
     * @return \DateTime
     */
    public function setDateRdv(\stdClass $dateRdv): self
    {
        $this->dateRdv = date("Y-m-d H:i:s", strtotime($dateRdv->date_rdv));
        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
    
    public function toArray()
    {
        return ['dateRdv' => $this->dateRdv];
    }
}

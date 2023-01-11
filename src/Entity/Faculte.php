<?php

namespace App\Entity;

use App\Repository\FaculteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FaculteRepository::class)]
class Faculte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $facno;

    #[ORM\Column(type: 'string', length: 50)]
    private $facnom;

    #[ORM\Column(type: 'string', length: 100)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    public function __toString() {
        return $this->facno;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacno(): ?int
    {
        return $this->facno;
    }

    public function setFacno(int $facno): self
    {
        $this->facno = $facno;

        return $this;
    }

    public function getFacnom(): ?string
    {
        return $this->facnom;
    }

    public function setFacnom(string $facnom): self
    {
        $this->facnom = $facnom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}

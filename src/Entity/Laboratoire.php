<?php

namespace App\Entity;

use App\Repository\LaboratoireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LaboratoireRepository::class)]
class Laboratoire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', unique:true)]
    private $labno;

    #[ORM\Column(type: 'string', length: 50)]
    private $labnom;

    #[ORM\ManyToOne(inversedBy: 'facno',targetEntity: Faculte::class)]
    private $facno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabno(): ?int
    {
        return $this->labno;
    }

    public function setLabno(int $labno): self
    {
        $this->labno = $labno;

        return $this;
    }

    public function getLabnom(): ?string
    {
        return $this->labnom;
    }

    public function setLabnom(string $labnom): self
    {
        $this->labnom = $labnom;

        return $this;
    }

    public function getFacno(): ?Faculte
    {
        return $this->facno;
    }

    public function setFacno(?Faculte $facno): self
    {
        $this->facno = $facno;

        return $this;
    }
}

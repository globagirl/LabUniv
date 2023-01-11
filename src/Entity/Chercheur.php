<?php

namespace App\Entity;

use App\Repository\ChercheurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChercheurRepository::class)]
class Chercheur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', unique:true)]
    private $chno;

    #[ORM\Column(type: 'string', length: 50)]
    private $chnom;

    #[ORM\Column(type: 'string', length: 2)]
    private $grade;

    #[ORM\Column(type: 'string', length: 1)]
    private $status;

    #[ORM\Column(type: 'string', length: 10)]
    private $daterecrut;

    #[ORM\Column(type: 'float')]
    private $salaire;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prime;

    #[ORM\Column(type: 'string', length: 100)]
    private $email;

    #[ORM\ManyToOne(inversedBy: 'chno',targetEntity: self::class)]
    private $supno;

    #[ORM\ManyToOne(inversedBy: 'labno', targetEntity: Laboratoire::class)]
    private $labno;

    #[ORM\ManyToOne(inversedBy: 'facno',targetEntity: Faculte::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $facno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChno(): ?int
    {
        return $this->chno;
    }

    public function setChno(int $chno): self
    {
        $this->chno = $chno;

        return $this;
    }

    public function getChnom(): ?string
    {
        return $this->chnom;
    }

    public function setChnom(string $chnom): self
    {
        $this->chnom = $chnom;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDaterecrut(): ?string
    {
        return $this->daterecrut;
    }

    public function setDaterecrut(string $daterecrut): self
    {
        $this->daterecrut = $daterecrut;
        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getPrime(): ?float
    {
        return $this->prime;
    }

    public function setPrime(?float $prime): self
    {
        $this->prime = $prime;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSupno(): ?self
    {
        return $this->supno;
    }

    public function setSupno(?self $supno): self
    {
        $this->supno = $supno;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabno()
    {
        return $this->labno;
    }

    /**
     * @param mixed $labno
     */
    public function setLabno($labno): void
    {
        $this->labno = $labno;
    }

    /**
     * @return mixed
     */
    public function getFacno()
    {
        return $this->facno;
    }

    /**
     * @param mixed $facno
     */
    public function setFacno($facno): void
    {
        $this->facno = $facno;
    }


}

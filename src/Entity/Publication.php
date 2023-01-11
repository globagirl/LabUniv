<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, unique:true)]
    private $pubno;

    #[ORM\Column(type: 'string', length: 100)]
    private $titre;

    #[ORM\Column(type: 'string', length: 50)]
    private $theme;

    #[ORM\Column(type: 'string', length: 5)]
    private $typepub;

    #[ORM\Column(type: 'integer')]
    private $volume;

    #[ORM\Column(type: 'date')]
    private $datepub;

    #[ORM\Column(type: 'string', length: 50)]
    private $apparition;

    #[ORM\Column(type: 'string', length: 50)]
    private $editeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPubno(): ?string
    {
        return $this->pubno;
    }

    public function setPubno(string $pubno): self
    {
        $this->pubno = $pubno;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTypepub(): ?string
    {
        return $this->typepub;
    }

    public function setTypepub(string $typepub): self
    {
        $this->typepub = $typepub;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getDatepub(): ?\DateTimeInterface
    {
        return $this->datepub;
    }

    public function setDatepub(\DateTimeInterface $datepub): self
    {
        $this->datepub = $datepub;

        return $this;
    }

    public function getApparition(): ?string
    {
        return $this->apparition;
    }

    public function setApparition(string $apparition): self
    {
        $this->apparition = $apparition;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }
}

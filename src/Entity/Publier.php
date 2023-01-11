<?php

namespace App\Entity;

use App\Repository\PublierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublierRepository::class)]
class Publier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $rang;

    #[ORM\ManyToOne(inversedBy: 'chno',targetEntity: Chercheur::class)]
    private $chno;

    #[ORM\ManyToOne(inversedBy: 'pubno',targetEntity: Publication::class)]
    private $pubno;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * @param mixed $rang
     */
    public function setRang($rang): void
    {
        $this->rang = $rang;
    }

    /**
     * @return mixed
     */
    public function getChno()
    {
        return $this->chno;
    }

    /**
     * @param mixed $chno
     */
    public function setChno($chno): void
    {
        $this->chno = $chno;
    }

    /**
     * @return mixed
     */
    public function getPubno()
    {
        return $this->pubno;
    }

    /**
     * @param mixed $pubno
     */
    public function setPubno($pubno): void
    {
        $this->pubno = $pubno;
    }

}

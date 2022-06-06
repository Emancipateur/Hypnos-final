<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        "get",
         "post" => ["security" => "is_granted('ROLE_CLIENT')"],
    ],
    itemOperations: [
        "get",
        "put" => ["security" => "is_granted('ROLE_ADMIN') or object.owner == user"],
    ],
)]
#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
   
    #[ORM\Column(type: 'date')]
    private $debut;

    #[ORM\Column(type: 'date')]
    private $fin;

    #[ORM\ManyToOne(targetEntity: Suites::class, inversedBy: 'reservation')]
    private $suites;

    #[ORM\ManyToOne(targetEntity: Clients::class, inversedBy: 'reservation')]
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getSuites(): ?Suites
    {
        return $this->suites;
    }

    public function setSuites(?Suites $suites): self
    {
        $this->suites = $suites;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}

<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $OpenAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $CloseAt = null;

    #[Assert\Length(min: 20,max:250)]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private string $categorie = '';

    #[ORM\Column(length: 255)]
    private string $statut = '';

    #[ORM\Column(length: 255)]
    private string $responsable = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getOpenAt(): ?\DateTimeImmutable
    {
        return $this->OpenAt;
    }

    public function setOpenAt(\DateTimeImmutable $OpenAt): static
    {
        $this->OpenAt = $OpenAt;

        return $this;
    }

    public function getCloseAt(): ?\DateTimeImmutable
    {
        return $this->CloseAt;
    }

    public function setCloseAt(\DateTimeImmutable $CloseAt): static
    {
        $this->CloseAt = $CloseAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(string $responsable): static
    {
        $this->responsable = $responsable;

        return $this;
    }
}

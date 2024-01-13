<?php

namespace App\Entity;

use App\Repository\MailEdusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailEdusRepository::class)]
class MailEdus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datenvoi = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'mailEduses')]
    private ?Educateur $educateurid = null;

    public function __construct()
    {
        $this->datenvoi = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatenvoi(): ?\DateTimeInterface
    {
        return $this->datenvoi;
    }

    public function setDatenvoi(\DateTimeInterface $datenvoi): static
    {
        $this->datenvoi = $datenvoi;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): static
    {
        $this->objet = $objet;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getEducateurid(): ?Educateur
    {
        return $this->educateurid;
    }

    public function setEducateurid(?Educateur $educateurid): static
    {
        $this->educateurid = $educateurid;

        return $this;
    }
}

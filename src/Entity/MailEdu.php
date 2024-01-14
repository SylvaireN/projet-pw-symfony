<?php

namespace App\Entity;

use App\Repository\MailEduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailEduRepository::class)]
class MailEdu
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

    #[ORM\ManyToMany(targetEntity: Educateur::class, inversedBy: 'mailEdus')]
    private Collection $educateurid;

    public function __construct()
    {
        $this->educateurid = new ArrayCollection();
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

    /**
     * @return Collection<int, Educateur>
     */
    public function getEducateurid(): Collection
    {
        return $this->educateurid;
    }

    public function addEducateurid(Educateur $educateurid): static
    {
        if (!$this->educateurid->contains($educateurid)) {
            $this->educateurid->add($educateurid);
        }

        return $this;
    }

    public function removeEducateurid(Educateur $educateurid): static
    {
        $this->educateurid->removeElement($educateurid);

        return $this;
    }
}

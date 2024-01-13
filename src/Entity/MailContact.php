<?php

namespace App\Entity;

use App\Repository\MailContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailContactRepository::class)]
class MailContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datenvoie = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'mailContacts')]
    private Collection $licenciecontact;

    public function __construct()
    {
        $this->licenciecontact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatenvoie(): ?\DateTimeInterface
    {
        return $this->datenvoie;
    }

    public function setDatenvoie(\DateTimeInterface $datenvoie): static
    {
        $this->datenvoie = $datenvoie;

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
     * @return Collection<int, Contact>
     */
    public function getLicenciecontact(): Collection
    {
        return $this->licenciecontact;
    }

    public function addLicenciecontact(Contact $licenciecontact): static
    {
        if (!$this->licenciecontact->contains($licenciecontact)) {
            $this->licenciecontact->add($licenciecontact);
        }

        return $this;
    }

    public function removeLicenciecontact(Contact $licenciecontact): static
    {
        $this->licenciecontact->removeElement($licenciecontact);

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\EducateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EducateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Educateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(inversedBy: 'educateur', cascade: ['persist', 'remove'])]
    private ?Licencie $licencieid = null;

    #[ORM\ManyToMany(targetEntity: MailEdu::class, mappedBy: 'educateurid')]
    private Collection $mailEdus;

    #[ORM\OneToMany(mappedBy: 'educateurid', targetEntity: MailEdus::class)]
    private Collection $mailEduses;

    public function __construct()
    {
        $this->mailEdus = new ArrayCollection();
        $this->mailEduses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLicencieid(): ?Licencie
    {
        return $this->licencieid;
    }

    public function setLicencieid(?Licencie $licencieid): static
    {
        $this->licencieid = $licencieid;

        return $this;
    }

    /**
     * @return Collection<int, MailEdu>
     */
    public function getMailEdus(): Collection
    {
        return $this->mailEdus;
    }

    public function addMailEdu(MailEdu $mailEdu): static
    {
        if (!$this->mailEdus->contains($mailEdu)) {
            $this->mailEdus->add($mailEdu);
            $mailEdu->addEducateurid($this);
        }

        return $this;
    }

    public function removeMailEdu(MailEdu $mailEdu): static
    {
        if ($this->mailEdus->removeElement($mailEdu)) {
            $mailEdu->removeEducateurid($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MailEdus>
     */
    public function getMailEduses(): Collection
    {
        return $this->mailEduses;
    }

    public function addMailEdus(MailEdus $mailEdus): static
    {
        if (!$this->mailEduses->contains($mailEdus)) {
            $this->mailEduses->add($mailEdus);
            $mailEdus->setEducateurid($this);
        }

        return $this;
    }

    public function removeMailEdus(MailEdus $mailEdus): static
    {
        if ($this->mailEduses->removeElement($mailEdus)) {
            // set the owning side to null (unless already changed)
            if ($mailEdus->getEducateurid() === $this) {
                $mailEdus->setEducateurid(null);
            }
        }

        return $this;
    }
}

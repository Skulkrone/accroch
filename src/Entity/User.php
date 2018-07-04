<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="username", message="Username déjà pris")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $fullName;
 
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $username;
 
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
 
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    
    private $typeRoles;
    
    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shop", mappedBy="fkUserId")
     */
    private $fkShopId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Announcements", mappedBy="fkUserId")
     */
    private $fkAnnouncements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invoices", mappedBy="fkUserId")
     */
    private $fkInvoicesUserId;

    public function __construct()
    {
        $this->fkShopId = new ArrayCollection();
        $this->fkAnnouncements = new ArrayCollection();
        $this->fkInvoicesUserId = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Retourne les rôles de l'user
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // Afin d'être sûr qu'un user a toujours au moins 1 rôle
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * Retour le salt qui a servi à coder le mot de passe
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // Nous n'avons pas besoin de cette methode car nous n'utilions pas de plainPassword
        // Mais elle est obligatoire car comprise dans l'interface UserInterface
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        return serialize([$this->id, $this->username, $this->password]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }

    

    /**
     * @return Collection|Shop[]
     */
    public function getFkShopId(): Collection
    {
        return $this->fkShopId;
    }

    public function addFkShopId(Shop $fkShopId): self
    {
        if (!$this->fkShopId->contains($fkShopId)) {
            $this->fkShopId[] = $fkShopId;
            $fkShopId->setFkUserId($this);
        }

        return $this;
    }

    public function removeFkShopId(Shop $fkShopId): self
    {
        if ($this->fkShopId->contains($fkShopId)) {
            $this->fkShopId->removeElement($fkShopId);
            // set the owning side to null (unless already changed)
            if ($fkShopId->getFkUserId() === $this) {
                $fkShopId->setFkUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Announcements[]
     */
    public function getFkAnnouncements(): Collection
    {
        return $this->fkAnnouncements;
    }

    public function addFkAnnouncement(Announcements $fkAnnouncement): self
    {
        if (!$this->fkAnnouncements->contains($fkAnnouncement)) {
            $this->fkAnnouncements[] = $fkAnnouncement;
            $fkAnnouncement->setFkUserId($this);
        }

        return $this;
    }

    public function removeFkAnnouncement(Announcements $fkAnnouncement): self
    {
        if ($this->fkAnnouncements->contains($fkAnnouncement)) {
            $this->fkAnnouncements->removeElement($fkAnnouncement);
            // set the owning side to null (unless already changed)
            if ($fkAnnouncement->getFkUserId() === $this) {
                $fkAnnouncement->setFkUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoices[]
     */
    public function getFkInvoicesUserId(): Collection
    {
        return $this->fkInvoicesUserId;
    }

    public function addFkInvoicesUserId(Invoices $fkInvoicesUserId): self
    {
        if (!$this->fkInvoicesUserId->contains($fkInvoicesUserId)) {
            $this->fkInvoicesUserId[] = $fkInvoicesUserId;
            $fkInvoicesUserId->setFkUserId($this);
        }

        return $this;
    }

    public function removeFkInvoicesUserId(Invoices $fkInvoicesUserId): self
    {
        if ($this->fkInvoicesUserId->contains($fkInvoicesUserId)) {
            $this->fkInvoicesUserId->removeElement($fkInvoicesUserId);
            // set the owning side to null (unless already changed)
            if ($fkInvoicesUserId->getFkUserId() === $this) {
                $fkInvoicesUserId->setFkUserId(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }
    
    public function getTypeRoles()
    {
        $typeRoles = $this->typeRoles;
        return $typeRoles;
    }

    public function setTypeRoles($typeRoles): void
    {
        $this->typeRoles = $typeRoles;
    }
}

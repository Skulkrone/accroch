<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
private $Name;

/**
 * @var string
 *
 * @ORM\Column(type="string")
 * @Assert\NotBlank()
 */
private $firstName;

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
 * @Assert\Email(strict=true, message="Le format de l'email '{{ value }}' est incorrect.")
 * @Assert\Email(checkMX = true, message = "Aucun serveur mail n'a été trouvé pour ce domaine.")
 */
private $email;

/**
 * @var string
 *
 * @ORM\Column(type="string", length=64)
 * @Assert\Regex(
 *  pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
 *  message="Le mot de passe doit comporter sept caractères ou plus et contenir au moins un chiffre, un caractère majuscule et un caractère minuscule."
 * )
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

/**
 * @ORM\Column(type="string", nullable=true)
 * 
 * @Assert\NotBlank(message="Please, upload the avatar as an image.")
 * @Assert\File(mimeTypes={ "image/png",
 *          "image/jpeg",
 *          "image/jpg" })
 * @Assert\Image(
 *     minWidth = 200,
 *     maxWidth = 400,
 *     minHeight = 200,
 *     maxHeight = 400
 * )
 */
private $Avatar;

/**
 * @ORM\Column(type="string", length=100)
 */
private $Address;

/**
 * @ORM\Column(type="integer")
 */
private $PostalCode;

/**
 * @ORM\Column(type="string", length=50)
 */
private $City;

/**
 * @ORM\Column(type="string", length=10)
 */
private $Phone;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="fkFromUserId")
 */
private $fkFromId;

public function __construct()
{
$this->fkShopId = new ArrayCollection();
$this->fkAnnouncements = new ArrayCollection();
$this->fkInvoicesUserId = new ArrayCollection();
$this->fkFromId = new ArrayCollection();
$this->fkToId = new ArrayCollection();
}

public function getId(): int
{
return $this->id;
}

public function __toString()
{
return $this->username;
}

public function setName(string $Name): void
{
$this->Name = $Name;
}

public function getName(): ?string
{
return $this->Name;
}

public function setFirstName(string $firstName): void
{
$this->firstName = $firstName;
}

public function getFirstName(): ?string
{
return $this->firstName;
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


public function getTypeRoles()
{
$typeRoles = $this->typeRoles;
return $typeRoles;
}

public function setTypeRoles($typeRoles): void
{
$this->typeRoles = $typeRoles;
}

public function getAvatar()
{
return $this->Avatar;
}

public function setAvatar($Avatar): self
{
$this->Avatar = $Avatar;

return $this;
}

public function getAddress(): ?string
{
    return $this->Address;
}


public function setAddress(string $Address): self
{
    $this->Address = $Address;
  return $this;
}

public function getPostalCode(): ?int
{
    return $this->PostalCode;
}


public function setPostalCode(int $PostalCode): self
{
    $this->PostalCode = $PostalCode;

    return $this;
}

public function getCity(): ?string
{
    return $this->City;
}


public function setCity(string $City): self
{
    $this->City = $City;

    return $this;
}

public function getPhone(): ?int
{
    return $this->Phone;
}

public function setPhone(int $Phone): self
{
    $this->Phone = $Phone;
    return $this;
}

/**
 * @return Collection|Messages[]
 */
public function getFkFromId(): Collection
{
    return $this->fkFromId;
}

public function addFkFromId(Messages $fkFromId): self
{
    if (!$this->fkFromId->contains($fkFromId)) {
        $this->fkFromId[] = $fkFromId;
        $fkFromId->setFkFromUserId($this);
    }

    return $this;
}

/**
 * @ORM\OneToMany(targetEntity="App\Entity\Messages", mappedBy="fkToUserId")
 */
private $fkToId;
public function removeFkFromId(Messages $fkFromId): self
{
    if ($this->fkFromId->contains($fkFromId)) {
        $this->fkFromId->removeElement($fkFromId);
        // set the owning side to null (unless already changed)
        if ($fkFromId->getFkFromUserId() === $this) {
            $fkFromId->setFkFromUserId(null);
        }
    }

    return $this;
}

/**
 * @return Collection|Messages[]
 */
public function getFkToId(): Collection
{
    return $this->fkToId;
}

public function addFkToId(Messages $fkToId): self
{
    if (!$this->fkToId->contains($fkToId)) {
        $this->fkToId[] = $fkToId;
        $fkToId->setFkToUserId($this);
    }

    return $this;
}

public function removeFkToId(Messages $fkToId): self
{
    if ($this->fkToId->contains($fkToId)) {
        $this->fkToId->removeElement($fkToId);
        // set the owning side to null (unless already changed)
        if ($fkToId->getFkToUserId() === $this) {
            $fkToId->setFkToUserId(null);
        }
    }

    return $this;
}


}

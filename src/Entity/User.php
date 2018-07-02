<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageUser;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Role;

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

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getImageUser(): ?string
    {
        return $this->ImageUser;
    }

    public function setImageUser(?string $ImageUser): self
    {
        $this->ImageUser = $ImageUser;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
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
}

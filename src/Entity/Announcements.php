<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnouncementsRepository")
 */
class Announcements
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Size;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Weight;

    /**
     * @ORM\Column(type="text")
     */
    private $Quality;

    /**
     * @ORM\Column(type="text")
     */
    private $Specifications;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImageAnnouncements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkAnnouncements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkUserId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CatAnnouncements", mappedBy="fkAnnouncementsId")
     */
    private $fkCatAnnouncementsId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Banner", mappedBy="fkAnnouncementsId")
     */
    private $fkBannerId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invoices", mappedBy="fkAnnoucementsId")
     */
    private $fkInvoicesAnnoucementsId;

    public function __construct()
    {
        $this->fkCatAnnouncementsId = new ArrayCollection();
        $this->fkBannerId = new ArrayCollection();
        $this->fkInvoicesAnnoucementsId = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->Size;
    }

    public function setSize(int $Size): self
    {
        $this->Size = $Size;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->Weight;
    }

    public function setWeight(int $Weight): self
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getQuality(): ?string
    {
        return $this->Quality;
    }

    public function setQuality(string $Quality): self
    {
        $this->Quality = $Quality;

        return $this;
    }

    public function getSpecifications(): ?string
    {
        return $this->Specifications;
    }

    public function setSpecifications(string $Specifications): self
    {
        $this->Specifications = $Specifications;

        return $this;
    }

    public function getImageAnnouncements(): ?string
    {
        return $this->ImageAnnouncements;
    }

    public function setImageAnnouncements(string $ImageAnnouncements): self
    {
        $this->ImageAnnouncements = $ImageAnnouncements;

        return $this;
    }

    public function getFkUserId(): ?User
    {
        return $this->fkUserId;
    }

    public function setFkUserId(?User $fkUserId): self
    {
        $this->fkUserId = $fkUserId;

        return $this;
    }

    /**
     * @return Collection|CatAnnouncements[]
     */
    public function getFkCatAnnouncementsId(): Collection
    {
        return $this->fkCatAnnouncementsId;
    }

    public function addFkCatAnnouncementsId(CatAnnouncements $fkCatAnnouncementsId): self
    {
        if (!$this->fkCatAnnouncementsId->contains($fkCatAnnouncementsId)) {
            $this->fkCatAnnouncementsId[] = $fkCatAnnouncementsId;
            $fkCatAnnouncementsId->setFkAnnouncementsId($this);
        }

        return $this;
    }

    public function removeFkCatAnnouncementsId(CatAnnouncements $fkCatAnnouncementsId): self
    {
        if ($this->fkCatAnnouncementsId->contains($fkCatAnnouncementsId)) {
            $this->fkCatAnnouncementsId->removeElement($fkCatAnnouncementsId);
            // set the owning side to null (unless already changed)
            if ($fkCatAnnouncementsId->getFkAnnouncementsId() === $this) {
                $fkCatAnnouncementsId->setFkAnnouncementsId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Banner[]
     */
    public function getFkBannerId(): Collection
    {
        return $this->fkBannerId;
    }

    public function addFkBannerId(Banner $fkBannerId): self
    {
        if (!$this->fkBannerId->contains($fkBannerId)) {
            $this->fkBannerId[] = $fkBannerId;
            $fkBannerId->setFkAnnouncementsId($this);
        }

        return $this;
    }

    public function removeFkBannerId(Banner $fkBannerId): self
    {
        if ($this->fkBannerId->contains($fkBannerId)) {
            $this->fkBannerId->removeElement($fkBannerId);
            // set the owning side to null (unless already changed)
            if ($fkBannerId->getFkAnnouncementsId() === $this) {
                $fkBannerId->setFkAnnouncementsId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invoices[]
     */
    public function getFkInvoicesAnnoucementsId(): Collection
    {
        return $this->fkInvoicesAnnoucementsId;
    }

    public function addFkInvoicesAnnoucementsId(Invoices $fkInvoicesAnnoucementsId): self
    {
        if (!$this->fkInvoicesAnnoucementsId->contains($fkInvoicesAnnoucementsId)) {
            $this->fkInvoicesAnnoucementsId[] = $fkInvoicesAnnoucementsId;
            $fkInvoicesAnnoucementsId->setFkAnnoucementsId($this);
        }

        return $this;
    }

    public function removeFkInvoicesAnnoucementsId(Invoices $fkInvoicesAnnoucementsId): self
    {
        if ($this->fkInvoicesAnnoucementsId->contains($fkInvoicesAnnoucementsId)) {
            $this->fkInvoicesAnnoucementsId->removeElement($fkInvoicesAnnoucementsId);
            // set the owning side to null (unless already changed)
            if ($fkInvoicesAnnoucementsId->getFkAnnoucementsId() === $this) {
                $fkInvoicesAnnoucementsId->setFkAnnoucementsId(null);
            }
        }

        return $this;
    }
}

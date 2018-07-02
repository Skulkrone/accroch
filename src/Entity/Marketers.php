<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MarketersRepository")
 */
class Marketers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Label;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Banner", mappedBy="fkMarketersId")
     */
    private $fkBannerMarketersId;

    public function __construct()
    {
        $this->fkBannerMarketersId = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(string $Label): self
    {
        $this->Label = $Label;

        return $this;
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

    /**
     * @return Collection|Banner[]
     */
    public function getFkBannerMarketersId(): Collection
    {
        return $this->fkBannerMarketersId;
    }

    public function addFkBannerMarketersId(Banner $fkBannerMarketersId): self
    {
        if (!$this->fkBannerMarketersId->contains($fkBannerMarketersId)) {
            $this->fkBannerMarketersId[] = $fkBannerMarketersId;
            $fkBannerMarketersId->setFkMarketersId($this);
        }

        return $this;
    }

    public function removeFkBannerMarketersId(Banner $fkBannerMarketersId): self
    {
        if ($this->fkBannerMarketersId->contains($fkBannerMarketersId)) {
            $this->fkBannerMarketersId->removeElement($fkBannerMarketersId);
            // set the owning side to null (unless already changed)
            if ($fkBannerMarketersId->getFkMarketersId() === $this) {
                $fkBannerMarketersId->setFkMarketersId(null);
            }
        }

        return $this;
    }
}

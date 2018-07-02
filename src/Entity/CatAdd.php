<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatAddRepository")
 */
class CatAdd
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
    private $Label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Banner", mappedBy="fkCatAddId")
     */
    private $fkBannerCatAdd;

    public function __construct()
    {
        $this->fkBannerCatAdd = new ArrayCollection();
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

    /**
     * @return Collection|Banner[]
     */
    public function getFkBannerCatAdd(): Collection
    {
        return $this->fkBannerCatAdd;
    }

    public function addFkBannerCatAdd(Banner $fkBannerCatAdd): self
    {
        if (!$this->fkBannerCatAdd->contains($fkBannerCatAdd)) {
            $this->fkBannerCatAdd[] = $fkBannerCatAdd;
            $fkBannerCatAdd->setFkCatAddId($this);
        }

        return $this;
    }

    public function removeFkBannerCatAdd(Banner $fkBannerCatAdd): self
    {
        if ($this->fkBannerCatAdd->contains($fkBannerCatAdd)) {
            $this->fkBannerCatAdd->removeElement($fkBannerCatAdd);
            // set the owning side to null (unless already changed)
            if ($fkBannerCatAdd->getFkCatAddId() === $this) {
                $fkBannerCatAdd->setFkCatAddId(null);
            }
        }

        return $this;
    }
}

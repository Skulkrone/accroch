<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatShopRepository")
 */
class CatShop
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageCatShop;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="fkCatShopId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkShopId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="fkCatShopId")
     */
    private $fkCatShopProdId;

    public function __construct()
    {
        $this->fkCatShopProdId = new ArrayCollection();
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

    public function getImageCatShop(): ?string
    {
        return $this->ImageCatShop;
    }

    public function setImageCatShop(?string $ImageCatShop): self
    {
        $this->ImageCatShop = $ImageCatShop;

        return $this;
    }

    public function getFkShopId(): ?Shop
    {
        return $this->fkShopId;
    }

    public function setFkShopId(?Shop $fkShopId): self
    {
        $this->fkShopId = $fkShopId;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getFkCatShopProdId(): Collection
    {
        return $this->fkCatShopProdId;
    }

    public function addFkCatShopProdId(Products $fkCatShopProdId): self
    {
        if (!$this->fkCatShopProdId->contains($fkCatShopProdId)) {
            $this->fkCatShopProdId[] = $fkCatShopProdId;
            $fkCatShopProdId->setFkCatShopId($this);
        }

        return $this;
    }

    public function removeFkCatShopProdId(Products $fkCatShopProdId): self
    {
        if ($this->fkCatShopProdId->contains($fkCatShopProdId)) {
            $this->fkCatShopProdId->removeElement($fkCatShopProdId);
            // set the owning side to null (unless already changed)
            if ($fkCatShopProdId->getFkCatShopId() === $this) {
                $fkCatShopProdId->setFkCatShopId(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkShopId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkUserId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CatShop", mappedBy="fkShopId")
     */
    private $fkCatShopId;

    public function __construct()
    {
        $this->fkCatShopId = new ArrayCollection();
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
     * @return Collection|CatShop[]
     */
    public function getFkCatShopId(): Collection
    {
        return $this->fkCatShopId;
    }

    public function addFkCatShopId(CatShop $fkCatShopId): self
    {
        if (!$this->fkCatShopId->contains($fkCatShopId)) {
            $this->fkCatShopId[] = $fkCatShopId;
            $fkCatShopId->setFkShopId($this);
        }

        return $this;
    }

    public function removeFkCatShopId(CatShop $fkCatShopId): self
    {
        if ($this->fkCatShopId->contains($fkCatShopId)) {
            $this->fkCatShopId->removeElement($fkCatShopId);
            // set the owning side to null (unless already changed)
            if ($fkCatShopId->getFkShopId() === $this) {
                $fkCatShopId->setFkShopId(null);
            }
        }

        return $this;
    }
}

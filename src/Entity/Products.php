<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImageProducts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CatShop", inversedBy="fkCatShopProdId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkCatShopId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invoices", mappedBy="fkProductsId")
     */
    private $fkInvoicesProductsId;

    public function __construct()
    {
        $this->fkInvoicesProductsId = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getImageProducts(): ?string
    {
        return $this->ImageProducts;
    }

    public function setImageProducts(?string $ImageProducts): self
    {
        $this->ImageProducts = $ImageProducts;

        return $this;
    }

    public function getFkCatShopId(): ?CatShop
    {
        return $this->fkCatShopId;
    }

    public function setFkCatShopId(?CatShop $fkCatShopId): self
    {
        $this->fkCatShopId = $fkCatShopId;

        return $this;
    }

    /**
     * @return Collection|Invoices[]
     */
    public function getFkInvoicesProductsId(): Collection
    {
        return $this->fkInvoicesProductsId;
    }

    public function addFkInvoicesProductsId(Invoices $fkInvoicesProductsId): self
    {
        if (!$this->fkInvoicesProductsId->contains($fkInvoicesProductsId)) {
            $this->fkInvoicesProductsId[] = $fkInvoicesProductsId;
            $fkInvoicesProductsId->setFkProductsId($this);
        }

        return $this;
    }

    public function removeFkInvoicesProductsId(Invoices $fkInvoicesProductsId): self
    {
        if ($this->fkInvoicesProductsId->contains($fkInvoicesProductsId)) {
            $this->fkInvoicesProductsId->removeElement($fkInvoicesProductsId);
            // set the owning side to null (unless already changed)
            if ($fkInvoicesProductsId->getFkProductsId() === $this) {
                $fkInvoicesProductsId->setFkProductsId(null);
            }
        }

        return $this;
    }
}

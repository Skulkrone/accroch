<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoicesRepository")
 */
class Invoices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $Cost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="fkInvoicesProductsId")
     */
    private $fkProductsId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkInvoicesUserId")
     */
    private $fkUserId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Announcements", inversedBy="fkInvoicesAnnoucementsId")
     */
    private $fkAnnoucementsId;

    public function getId()
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->Cost;
    }

    public function setCost(float $Cost): self
    {
        $this->Cost = $Cost;

        return $this;
    }

    public function getFkProductsId(): ?Products
    {
        return $this->fkProductsId;
    }

    public function setFkProductsId(?Products $fkProductsId): self
    {
        $this->fkProductsId = $fkProductsId;

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

    public function getFkAnnoucementsId(): ?Announcements
    {
        return $this->fkAnnoucementsId;
    }

    public function setFkAnnoucementsId(?Announcements $fkAnnoucementsId): self
    {
        $this->fkAnnoucementsId = $fkAnnoucementsId;

        return $this;
    }
}

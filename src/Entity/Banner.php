<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BannerRepository")
 */
class Banner
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
     * @ORM\Column(type="string", length=255)
     */
    private $ImageBanner;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Announcements", inversedBy="fkBannerId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkAnnouncementsId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CatAdd", inversedBy="fkBannerCatAdd")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkCatAddId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marketers", inversedBy="fkBannerMarketersId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkMarketersId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Position;

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

    public function getImageBanner(): ?string
    {
        return $this->ImageBanner;
    }

    public function setImageBanner(string $ImageBanner): self
    {
        $this->ImageBanner = $ImageBanner;

        return $this;
    }

    public function getFkAnnouncementsId(): ?Announcements
    {
        return $this->fkAnnouncementsId;
    }

    public function setFkAnnouncementsId(?Announcements $fkAnnouncementsId): self
    {
        $this->fkAnnouncementsId = $fkAnnouncementsId;

        return $this;
    }

    public function getFkCatAddId(): ?CatAdd
    {
        return $this->fkCatAddId;
    }

    public function setFkCatAddId(?CatAdd $fkCatAddId): self
    {
        $this->fkCatAddId = $fkCatAddId;

        return $this;
    }

    public function getFkMarketersId(): ?Marketers
    {
        return $this->fkMarketersId;
    }

    public function setFkMarketersId(?Marketers $fkMarketersId): self
    {
        $this->fkMarketersId = $fkMarketersId;

        return $this;
    }

    public function getPosition(): ?bool
    {
        return $this->Position;
    }

    public function setPosition(bool $Position): self
    {
        $this->Position = $Position;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatAnnouncementsRepository")
 */
class CatAnnouncements
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Announcements", inversedBy="fkCatAnnouncementsId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkAnnouncementsId;

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

    public function getFkAnnouncementsId(): ?Announcements
    {
        return $this->fkAnnouncementsId;
    }

    public function setFkAnnouncementsId(?Announcements $fkAnnouncementsId): self
    {
        $this->fkAnnouncementsId = $fkAnnouncementsId;

        return $this;
    }
}

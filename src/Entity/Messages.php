<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagesRepository")
 */
class Messages
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
    private $Content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ReadAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkFromId")
     */
    private $fkFromUserId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkToId")
     */
    private $fkToUserId;

    public function getId()
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getReadAt(): ?\DateTimeInterface
    {
        return $this->ReadAt;
    }

    public function setReadAt(?\DateTimeInterface $ReadAt): self
    {
        $this->ReadAt = $ReadAt;

        return $this;
    }

    public function getFkFromUserId(): ?User
    {
        return $this->fkFromUserId;
    }

    public function setFkFromUserId(?User $fkFromUserId): self
    {
        $this->fkFromUserId = $fkFromUserId;

        return $this;
    }

    public function getFkToUserId()
    {
        return $this->fkToUserId;
    }

    public function setFkToUserId(?string $fkToUserId): self
    {
        $this->fkToUserId = $fkToUserId;

        return $this;
    }
    
}

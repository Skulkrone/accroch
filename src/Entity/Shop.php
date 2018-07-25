<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

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
 * @ORM\Column(type="string", length=60)
 */
private $Label;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkShopId")
 * @ORM\JoinColumn(nullable=false)
 */
private $fkUserId;

/**
 * @ORM\OneToMany(targetEntity="App\Entity\CatShop", mappedBy="fkShopId")
 * 
 */
private $fkCatShopId;

/**
 * @ORM\Column(type="string", length=60, nullable=false)
 * @Assert\File(mimeTypes={"image/png", "image/jpg", "image/jpeg"})
 */
private $ShopImage;

/**
 * @ORM\Column(type="string", length=60, nullable=true)
 * @Assert\File(mimeTypes={"image/png", "image/jpg", "image/jpeg", "image/gif"})
 * @Assert\Image(
 *     minWidth = 400,
 *     maxWidth = 530,
 *     minHeight = 50,
 *     maxHeight = 250
 * )
 */
private $Logo;

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

public function getShopImage()
{
return $this->ShopImage;
}

public function setShopImage($ShopImage): self
{
$this->ShopImage = $ShopImage;

return $this;
}

function __toString(){
// to show the name of the Category in the select
return $this->fkCatShopId;
// to show the id of the Category in the select
// return $this->id;
}

public function getLogo()
{
return $this->Logo;
}

public function setLogo($Logo): self
{
$this->Logo = $Logo;

return $this;
}
}

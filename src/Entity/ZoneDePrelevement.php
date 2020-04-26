<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZoneDePrelevementRepository")
 */
class ZoneDePrelevement
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
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionX1;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionY1;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionX2;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionY2;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionX3;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionY3;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionX4;

    /**
     * @ORM\Column(type="float")
     */
    private $PositionY4;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plage", inversedBy="ZoneDePrelevements")
     */
    private $plage;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Espece", inversedBy="zoneDePrelevements")
     */
    private $ZoneDePrelevementHasEspece;

    public function __construct()
    {
        $this->ZoneDePrelevementHasEspece = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPositionX1(): ?float
    {
        return $this->PositionX1;
    }

    public function setPositionX1(float $PositionX1): self
    {
        $this->PositionX1 = $PositionX1;

        return $this;
    }

    public function getPositionY1(): ?float
    {
        return $this->PositionY1;
    }

    public function setPositionY1(float $PositionY1): self
    {
        $this->PositionY1 = $PositionY1;

        return $this;
    }

    public function getPositionX2(): ?float
    {
        return $this->PositionX2;
    }

    public function setPositionX2(float $PositionX2): self
    {
        $this->PositionX2 = $PositionX2;

        return $this;
    }

    public function getPositionY2(): ?float
    {
        return $this->PositionY2;
    }

    public function setPositionY2(float $PositionY2): self
    {
        $this->PositionY2 = $PositionY2;

        return $this;
    }

    public function getPositionX3(): ?float
    {
        return $this->PositionX3;
    }

    public function setPositionX3(float $PositionX3): self
    {
        $this->PositionX3 = $PositionX3;

        return $this;
    }

    public function getPositionY3(): ?float
    {
        return $this->PositionY3;
    }

    public function setPositionY3(float $PositionY3): self
    {
        $this->PositionY3 = $PositionY3;

        return $this;
    }

    public function getPositionX4(): ?float
    {
        return $this->PositionX4;
    }

    public function setPositionX4(float $PositionX4): self
    {
        $this->PositionX4 = $PositionX4;

        return $this;
    }

    public function getPositionY4(): ?float
    {
        return $this->PositionY4;
    }

    public function setPositionY4(float $PositionY4): self
    {
        $this->PositionY4 = $PositionY4;

        return $this;
    }

    public function getPlage(): ?Plage
    {
        return $this->plage;
    }

    public function setPlage(?Plage $plage): self
    {
        $this->plage = $plage;

        return $this;
    }

    /**
     * @return Collection|Espece[]
     */
    public function getZoneDePrelevementHasEspece(): Collection
    {
        return $this->ZoneDePrelevementHasEspece;
    }

    public function addZoneDePrelevementHasEspece(Espece $zoneDePrelevementHasEspece): self
    {
        if (!$this->ZoneDePrelevementHasEspece->contains($zoneDePrelevementHasEspece)) {
            $this->ZoneDePrelevementHasEspece[] = $zoneDePrelevementHasEspece;
        }

        return $this;
    }

    public function removeZoneDePrelevementHasEspece(Espece $zoneDePrelevementHasEspece): self
    {
        if ($this->ZoneDePrelevementHasEspece->contains($zoneDePrelevementHasEspece)) {
            $this->ZoneDePrelevementHasEspece->removeElement($zoneDePrelevementHasEspece);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement toString() method.
        return $this->nom;
    }
}

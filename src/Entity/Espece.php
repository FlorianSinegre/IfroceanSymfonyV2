<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EspeceRepository")
 */
class Espece
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
     * @ORM\ManyToMany(targetEntity="App\Entity\ZoneDePrelevement", mappedBy="ZoneDePrelevementHasEspece")
     */
    private $zoneDePrelevements;

    public function __construct()
    {
        $this->zoneDePrelevements = new ArrayCollection();
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

    /**
     * @return Collection|ZoneDePrelevement[]
     */
    public function getZoneDePrelevements(): Collection
    {
        return $this->zoneDePrelevements;
    }

    public function addZoneDePrelevement(ZoneDePrelevement $zoneDePrelevement): self
    {
        if (!$this->zoneDePrelevements->contains($zoneDePrelevement)) {
            $this->zoneDePrelevements[] = $zoneDePrelevement;
            $zoneDePrelevement->addZoneDePrelevementHasEspece($this);
        }

        return $this;
    }

    public function removeZoneDePrelevement(ZoneDePrelevement $zoneDePrelevement): self
    {
        if ($this->zoneDePrelevements->contains($zoneDePrelevement)) {
            $this->zoneDePrelevements->removeElement($zoneDePrelevement);
            $zoneDePrelevement->removeZoneDePrelevementHasEspece($this);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement toString() method.
        return $this->nom;
    }
}

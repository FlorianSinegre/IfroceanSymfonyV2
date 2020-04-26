<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlageRepository")
 */
class Plage
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune", inversedBy="Plages")
     */
    private $commune;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ZoneDePrelevement", mappedBy="plage")
     */
    private $ZoneDePrelevements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etude", mappedBy="EtudeHasPlage")
     */
    private $etudes;

    public function __construct()
    {
        $this->ZoneDePrelevements = new ArrayCollection();
        $this->etudes = new ArrayCollection();
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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * @return Collection|ZoneDePrelevement[]
     */
    public function getZoneDePrelevements(): Collection
    {
        return $this->ZoneDePrelevements;
    }

    public function addZoneDePrelevement(ZoneDePrelevement $zoneDePrelevement): self
    {
        if (!$this->ZoneDePrelevements->contains($zoneDePrelevement)) {
            $this->ZoneDePrelevements[] = $zoneDePrelevement;
            $zoneDePrelevement->setPlage($this);
        }

        return $this;
    }

    public function removeZoneDePrelevement(ZoneDePrelevement $zoneDePrelevement): self
    {
        if ($this->ZoneDePrelevements->contains($zoneDePrelevement)) {
            $this->ZoneDePrelevements->removeElement($zoneDePrelevement);
            // set the owning side to null (unless already changed)
            if ($zoneDePrelevement->getPlage() === $this) {
                $zoneDePrelevement->setPlage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etude[]
     */
    public function getEtudes(): Collection
    {
        return $this->etudes;
    }

    public function addEtude(Etude $etude): self
    {
        if (!$this->etudes->contains($etude)) {
            $this->etudes[] = $etude;
            $etude->addEtudeHasPlage($this);
        }

        return $this;
    }

    public function removeEtude(Etude $etude): self
    {
        if ($this->etudes->contains($etude)) {
            $this->etudes->removeElement($etude);
            $etude->removeEtudeHasPlage($this);
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement toString() method.
        return $this->nom;
    }
}

<?php

namespace App\Entity;

use App\Repository\AutorisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutorisationRepository::class)
 */
class Autorisation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $lecture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ecriture;

    /**
     * @ORM\OneToMany(targetEntity=Acces::class, mappedBy="autorisationid")
     */
    private $documentid;

    public function __construct()
    {
        $this->documentid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLecture(): ?bool
    {
        return $this->lecture;
    }

    public function setLecture(bool $lecture): self
    {
        $this->lecture = $lecture;

        return $this;
    }

    public function getEcriture(): ?bool
    {
        return $this->ecriture;
    }

    public function setEcriture(bool $ecriture): self
    {
        $this->ecriture = $ecriture;

        return $this;
    }

    /**
     * @return Collection|Acces[]
     */
    public function getDocumentid(): Collection
    {
        return $this->documentid;
    }

    public function addDocumentid(Acces $documentid): self
    {
        if (!$this->documentid->contains($documentid)) {
            $this->documentid[] = $documentid;
            $documentid->setAutorisationid($this);
        }

        return $this;
    }

    public function removeDocumentid(Acces $documentid): self
    {
        if ($this->documentid->removeElement($documentid)) {
            // set the owning side to null (unless already changed)
            if ($documentid->getAutorisationid() === $this) {
                $documentid->setAutorisationid(null);
            }
        }

        return $this;
    }
}

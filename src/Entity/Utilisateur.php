<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Acces::class, mappedBy="utilisateurid")
     */
    private $autorisationid;

    public function __construct()
    {
        $this->autorisationid = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|Acces[]
     */
    public function getAutorisationid(): Collection
    {
        return $this->autorisationid;
    }

    public function addAutorisationid(Acces $autorisationid): self
    {
        if (!$this->autorisationid->contains($autorisationid)) {
            $this->autorisationid[] = $autorisationid;
            $autorisationid->setUtilisateurid($this);
        }

        return $this;
    }

    public function removeAutorisationid(Acces $autorisationid): self
    {
        if ($this->autorisationid->removeElement($autorisationid)) {
            // set the owning side to null (unless already changed)
            if ($autorisationid->getUtilisateurid() === $this) {
                $autorisationid->setUtilisateurid(null);
            }
        }

        return $this;
    }
}

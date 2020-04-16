<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TacheRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 * fields={"titre"},
 * message="Une autre tache possede deja ce titre, merci de le modifier"
 * )
 */
class Tache
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min=10, max=255, minMessage="le titre doit etre plus de 10caractére !",
     *  maxMessage="le titre ne peut pas faire plus de 255 caractéres")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=100, minMessage="votre descriptionn doit etre plus de 100 caractére !")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heureDatePublication;

    /**
     * @ORM\Column(type="float")
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;
/**
     * Permet d'initialiser le slug!
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     */

    public function initializeSlug(){
        if(empty($this->slug)){
             $slugify =new  Slugify();
            $this->slug = $slugify->slugify($this->titre);
        }


    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHeureDatePublication(): ?\DateTimeInterface
    {
        return $this->heureDatePublication;
    }

    public function setHeureDatePublication(\DateTimeInterface $heureDatePublication): self
    {
        $this->heureDatePublication = $heureDatePublication;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}

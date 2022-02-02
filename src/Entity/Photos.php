<?php

namespace App\Entity;

use App\Repository\PhotosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotosRepository::class)
 */
class Photos
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Articles::class, mappedBy="imageEnAvant")
     */
    private $articleImagesEnAvant;

    /**
     * @ORM\ManyToOne(targetEntity=Annonces::class, inversedBy="imagesDuo")
     */
    private $annoncesImagesDuo;

    /**
     * @ORM\ManyToOne(targetEntity=Annonces::class, inversedBy="photosGalerie")
     */
    private $annoncesGalerie;

    public function __construct()
    {
        $this->articleImagesEnAvant = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticleImagesEnAvant(): Collection
    {
        return $this->articleImagesEnAvant;
    }

    public function addArticleImagesEnAvant(Articles $articleImagesEnAvant): self
    {
        if (!$this->articleImagesEnAvant->contains($articleImagesEnAvant)) {
            $this->articleImagesEnAvant[] = $articleImagesEnAvant;
            $articleImagesEnAvant->setImageEnAvant($this);
        }

        return $this;
    }

    public function removeArticleImagesEnAvant(Articles $articleImagesEnAvant): self
    {
        if ($this->articleImagesEnAvant->removeElement($articleImagesEnAvant)) {
            // set the owning side to null (unless already changed)
            if ($articleImagesEnAvant->getImageEnAvant() === $this) {
                $articleImagesEnAvant->setImageEnAvant(null);
            }
        }

        return $this;
    }

    public function getAnnoncesImagesDuo(): ?Annonces
    {
        return $this->annoncesImagesDuo;
    }

    public function setAnnoncesImagesDuo(?Annonces $annoncesImagesDuo): self
    {
        $this->annoncesImagesDuo = $annoncesImagesDuo;

        return $this;
    }

    public function getAnnoncesGalerie(): ?Annonces
    {
        return $this->annoncesGalerie;
    }

    public function setAnnoncesGalerie(?Annonces $annoncesGalerie): self
    {
        $this->annoncesGalerie = $annoncesGalerie;

        return $this;
    }
    public function __toString(){
        return $this->getName();
    }
}

<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
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
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaDescription;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionDuBien;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $coupDeCoeur = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @return mixed
     */
    public function getNombreDePiece()
    {
        return $this->nombreDePiece;
    }

    /**
     * @param mixed $nombreDePiece
     */
    public function setNombreDePiece($nombreDePiece): void
    {
        $this->nombreDePiece = $nombreDePiece;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreDePiece;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImageEnAvant;

    /**
     * @ORM\OneToMany(targetEntity=Photos::class, mappedBy="annoncesImagesDuo",cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $imagesDuo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surfaceHabitable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surfaceDuTerrain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surfaceDeLaTerrasse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreDeChambre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreDeSalleDeBain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreDeToilettes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombreEtages;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cheminee =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $piscine =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $garage =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $balcon =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $parking =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $jardin =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cave =0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gardien =0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $systemDeSecurite;

    /**
     * @ORM\OneToMany(targetEntity=Photos::class, mappedBy="annoncesGalerie",cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $photosGalerie;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $prixAvecHonoraires;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixSansHonoraires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeDeBien;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $terrasse;

    public function __construct()
    {
        $this->imagesDuo = new ArrayCollection();
        $this->photosGalerie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getDescriptionDuBien(): ?string
    {
        return $this->descriptionDuBien;
    }

    public function setDescriptionDuBien(string $descriptionDuBien): self
    {
        $this->descriptionDuBien = $descriptionDuBien;

        return $this;
    }

    public function getCoupDeCoeur(): ?bool
    {
        return $this->coupDeCoeur;
    }

    public function setCoupDeCoeur(?bool $coupDeCoeur): self
    {
        $this->coupDeCoeur = $coupDeCoeur;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }



    /**
     * @return Collection|Photos[]
     */
    public function getImagesDuo(): Collection
    {
        return $this->imagesDuo;
    }

    public function addImagesDuo(Photos $imagesDuo): self
    {
        if (!$this->imagesDuo->contains($imagesDuo)) {
            $this->imagesDuo[] = $imagesDuo;
            $imagesDuo->setAnnoncesImagesDuo($this);
        }

        return $this;
    }

    public function removeImagesDuo(Photos $imagesDuo): self
    {
        if ($this->imagesDuo->removeElement($imagesDuo)) {
            // set the owning side to null (unless already changed)
            if ($imagesDuo->getAnnoncesImagesDuo() === $this) {
                $imagesDuo->setAnnoncesImagesDuo(null);
            }
        }

        return $this;
    }

    public function getSurfaceHabitable(): ?string
    {
        return $this->surfaceHabitable;
    }

    public function setSurfaceHabitable(?string $surfaceHabitable): self
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    public function getSurfaceDuTerrain(): ?string
    {
        return $this->surfaceDuTerrain;
    }

    public function setSurfaceDuTerrain(?string $surfaceDuTerrain): self
    {
        $this->surfaceDuTerrain = $surfaceDuTerrain;

        return $this;
    }

    public function getSurfaceDeLaTerrasse(): ?string
    {
        return $this->surfaceDeLaTerrasse;
    }

    public function setSurfaceDeLaTerrasse(?string $surfaceDeLaTerrasse): self
    {
        $this->surfaceDeLaTerrasse = $surfaceDeLaTerrasse;

        return $this;
    }

    public function getNombreDeChambre(): ?string
    {
        return $this->nombreDeChambre;
    }

    public function setNombreDeChambre(?string $nombreDeChambre): self
    {
        $this->nombreDeChambre = $nombreDeChambre;

        return $this;
    }

    public function getNombreDeSalleDeBain(): ?string
    {
        return $this->nombreDeSalleDeBain;
    }

    public function setNombreDeSalleDeBain(?string $nombreDeSalleDeBain): self
    {
        $this->nombreDeSalleDeBain = $nombreDeSalleDeBain;

        return $this;
    }

    public function getNombreDeToilettes(): ?int
    {
        return $this->nombreDeToilettes;
    }

    public function setNombreDeToilettes(?int $nombreDeToilettes): self
    {
        $this->nombreDeToilettes = $nombreDeToilettes;

        return $this;
    }

    public function getNombreEtages(): ?int
    {
        return $this->nombreEtages;
    }

    public function setNombreEtages(int $nombreEtages): self
    {
        $this->nombreEtages = $nombreEtages;

        return $this;
    }

    public function getCheminee(): ?bool
    {
        return $this->cheminee;
    }

    public function setCheminee(?bool $cheminee): self
    {
        $this->cheminee = $cheminee;

        return $this;
    }

    public function getPiscine(): ?bool
    {
        return $this->piscine;
    }

    public function setPiscine(?bool $piscine): self
    {
        $this->piscine = $piscine;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageEnAvant()
    {
        return $this->ImageEnAvant;
    }

    /**
     * @param mixed $ImageEnAvant
     */
    public function setImageEnAvant($ImageEnAvant): void
    {
        $this->ImageEnAvant = $ImageEnAvant;
    }

    public function getGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(?bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getBalcon(): ?bool
    {
        return $this->balcon;
    }

    public function setBalcon(?bool $balcon): self
    {
        $this->balcon = $balcon;

        return $this;
    }

    public function getParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(?bool $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(?bool $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }

    public function getCave(): ?bool
    {
        return $this->cave;
    }

    public function setCave(?bool $cave): self
    {
        $this->cave = $cave;

        return $this;
    }

    public function getGardien(): ?bool
    {
        return $this->gardien;
    }

    public function setGardien(?bool $gardien): self
    {
        $this->gardien = $gardien;

        return $this;
    }

    public function getSystemDeSecurite(): ?string
    {
        return $this->systemDeSecurite;
    }

    public function setSystemDeSecurite(?string $systemDeSecurite): self
    {
        $this->systemDeSecurite = $systemDeSecurite;

        return $this;
    }

    /**
     * @return Collection|Photos[]
     */
    public function getPhotosGalerie(): Collection
    {
        return $this->photosGalerie;
    }

    public function addPhotosGalerie(Photos $photosGalerie): self
    {
        if (!$this->photosGalerie->contains($photosGalerie)) {
            $this->photosGalerie[] = $photosGalerie;
            $photosGalerie->setAnnoncesGalerie($this);
        }

        return $this;
    }

    public function removePhotosGalerie(Photos $photosGalerie): self
    {
        if ($this->photosGalerie->removeElement($photosGalerie)) {
            // set the owning side to null (unless already changed)
            if ($photosGalerie->getAnnoncesGalerie() === $this) {
                $photosGalerie->setAnnoncesGalerie(null);
            }
        }

        return $this;
    }

    public function getPrixAvecHonoraires(): ?int
    {
        return $this->prixAvecHonoraires;
    }

    public function setPrixAvecHonoraires(int $prixAvecHonoraires): self
    {
        $this->prixAvecHonoraires = $prixAvecHonoraires;

        return $this;
    }

    public function getPrixSansHonoraires(): ?int
    {
        return $this->prixSansHonoraires;
    }

    public function setPrixSansHonoraires(?int $prixSansHonoraires): self
    {
        $this->prixSansHonoraires = $prixSansHonoraires;

        return $this;
    }

    public function getTypeDeBien(): ?string
    {
        return $this->typeDeBien;
    }

    public function setTypeDeBien(string $typeDeBien): self
    {
        $this->typeDeBien = $typeDeBien;

        return $this;
    }

    public function getTerrasse(): ?bool
    {
        return $this->terrasse;
    }

    public function setTerrasse(?bool $terrasse): self
    {
        $this->terrasse = $terrasse;

        return $this;
    }

}

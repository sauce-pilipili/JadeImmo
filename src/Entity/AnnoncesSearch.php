<?php


namespace App\Entity;


use phpDocumentor\Reflection\Types\Boolean;

class AnnoncesSearch
{
 private $title ='';
 private boolean $coupDeCoeur;
 private $typeDeBien;
 private $localisation;
 private $surfaceHabitableMax;
 private $sufaceHabitableMin;
 private $surfaceDuTerrainMax;
 private $surfaceDuTerrainMin;
 private $nombreDeChambre;
 private $prixMax;
 private $prixMin;
 private boolean $piscine;
 private boolean $garage;
 private boolean $balcon;
 private boolean $parking;
 private boolean $jardin;
 private boolean $cave;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isCoupDeCoeur(): bool
    {
        return $this->coupDeCoeur;
    }

    /**
     * @param bool $coupDeCoeur
     */
    public function setCoupDeCoeur(bool $coupDeCoeur): void
    {
        $this->coupDeCoeur = $coupDeCoeur;
    }

    /**
     * @return mixed
     */
    public function getTypeDeBien()
    {
        return $this->typeDeBien;
    }

    /**
     * @param mixed $typeDeBien
     */
    public function setTypeDeBien($typeDeBien): void
    {
        $this->typeDeBien = $typeDeBien;
    }

    /**
     * @return mixed
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param mixed $localisation
     */
    public function setLocalisation($localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return mixed
     */
    public function getSurfaceHabitableMax()
    {
        return $this->surfaceHabitableMax;
    }

    /**
     * @param mixed $surfaceHabitableMax
     */
    public function setSurfaceHabitableMax($surfaceHabitableMax): void
    {
        $this->surfaceHabitableMax = $surfaceHabitableMax;
    }

    /**
     * @return mixed
     */
    public function getSufaceHabitableMin()
    {
        return $this->sufaceHabitableMin;
    }

    /**
     * @param mixed $sufaceHabitableMin
     */
    public function setSufaceHabitableMin($sufaceHabitableMin): void
    {
        $this->sufaceHabitableMin = $sufaceHabitableMin;
    }

    /**
     * @return mixed
     */
    public function getSurfaceDuTerrainMax()
    {
        return $this->surfaceDuTerrainMax;
    }

    /**
     * @param mixed $surfaceDuTerrainMax
     */
    public function setSurfaceDuTerrainMax($surfaceDuTerrainMax): void
    {
        $this->surfaceDuTerrainMax = $surfaceDuTerrainMax;
    }

    /**
     * @return mixed
     */
    public function getSurfaceDuTerrainMin()
    {
        return $this->surfaceDuTerrainMin;
    }

    /**
     * @param mixed $surfaceDuTerrainMin
     */
    public function setSurfaceDuTerrainMin($surfaceDuTerrainMin): void
    {
        $this->surfaceDuTerrainMin = $surfaceDuTerrainMin;
    }

    /**
     * @return mixed
     */
    public function getNombreDeChambre()
    {
        return $this->nombreDeChambre;
    }

    /**
     * @param mixed $nombreDeChambre
     */
    public function setNombreDeChambre($nombreDeChambre): void
    {
        $this->nombreDeChambre = $nombreDeChambre;
    }

    /**
     * @return mixed
     */
    public function getPrixMax()
    {
        return $this->prixMax;
    }

    /**
     * @param mixed $prixMax
     */
    public function setPrixMax($prixMax): void
    {
        $this->prixMax = $prixMax;
    }

    /**
     * @return mixed
     */
    public function getPrixMin()
    {
        return $this->prixMin;
    }

    /**
     * @param mixed $prixMin
     */
    public function setPrixMin($prixMin): void
    {
        $this->prixMin = $prixMin;
    }

    /**
     * @return bool
     */
    public function isPiscine(): bool
    {
        return $this->piscine;
    }

    /**
     * @param bool $piscine
     */
    public function setPiscine(bool $piscine): void
    {
        $this->piscine = $piscine;
    }

    /**
     * @return bool
     */
    public function isGarage(): bool
    {
        return $this->garage;
    }

    /**
     * @param bool $garage
     */
    public function setGarage(bool $garage): void
    {
        $this->garage = $garage;
    }

    /**
     * @return bool
     */
    public function isBalcon(): bool
    {
        return $this->balcon;
    }

    /**
     * @param bool $balcon
     */
    public function setBalcon(bool $balcon): void
    {
        $this->balcon = $balcon;
    }

    /**
     * @return bool
     */
    public function isParking(): bool
    {
        return $this->parking;
    }

    /**
     * @param bool $parking
     */
    public function setParking(bool $parking): void
    {
        $this->parking = $parking;
    }

    /**
     * @return bool
     */
    public function isJardin(): bool
    {
        return $this->jardin;
    }

    /**
     * @param bool $jardin
     */
    public function setJardin(bool $jardin): void
    {
        $this->jardin = $jardin;
    }

    /**
     * @return bool
     */
    public function isCave(): bool
    {
        return $this->cave;
    }

    /**
     * @param bool $cave
     */
    public function setCave(bool $cave): void
    {
        $this->cave = $cave;
    }



}
<?php
namespace App\Data;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Colour;

class RechercheCriteria{
    /**
     * @var string
     */
    public $search = "";

    /**
     * @var Colour
     */
    public $colour = null;

    /**
     * @var Brand
     */
    public $brand = null;

    /**
     * @var string
     */
    public $region = "";

    /**
     * @var string
     */
    public $departement = "";

    /**
     * @var boolean
     */
    public $interieure = false;

    /**
     * @var boolean
     */
    public $exterieure = false;

    /**
     * @var boolean
     */
    public $outils = false;

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * @param string $search
     */
    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

    /**
     * @return Colour
     */
    public function getColour(): Colour
    {
        return $this->colour;
    }

    /**
     * @param Colour $colour
     */
    public function setColour(Colour $colour): void
    {
        $this->colour = $colour;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getDepartement(): string
    {
        return $this->departement;
    }

    /**
     * @param string $departement
     */
    public function setDepartement(string $departement): void
    {
        $this->departement = $departement;
    }

    /**
     * @return bool
     */
    public function isInterieure(): bool
    {
        return $this->interieure;
    }

    /**
     * @param bool $interieure
     */
    public function setInterieure(bool $interieure): void
    {
        $this->interieure = $interieure;
    }

    /**
     * @return bool
     */
    public function isExterieure(): bool
    {
        return $this->exterieure;
    }

    /**
     * @param bool $exterieure
     */
    public function setExterieure(bool $exterieure): void
    {
        $this->exterieure = $exterieure;
    }

    /**
     * @return bool
     */
    public function isOutils(): bool
    {
        return $this->outils;
    }

    /**
     * @param bool $outils
     */
    public function setOutils(bool $outils): void
    {
        $this->outils = $outils;
    }



}

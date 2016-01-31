<?php

namespace FleetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentująca zlecenie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Car
{
    /**
     * @var integer Identyfikator
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string Marka
     *
     * @ORM\Column(name="make", type="string", length=64)
     */
    private $make;

    /**
     * @var string Model
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var \DateTime Rok produkcji
     *
     * @ORM\Column(name="year", type="datetime", nullable=true)
     */
    private $year;

    /**
     * @var string Numer VIN
     *
     * @ORM\Column(name="vin", type="string", length=20, nullable=true)
     */
    private $vin;

    /**
     * @var string Rodzaj silnika
     *
     * @ORM\Column(name="engine", type="string", length=255, nullable=true)
     */
    private $engine;

    /**
     * Typ paliwa
     *
     * @ORM\ManyToOne(targetEntity="FuelType")
     * @ORM\JoinColumn(name="fuel_type", referencedColumnName="id", nullable=true)
     */
    private $fuelType;

    /**
     * Typ skrzyni biegów
     *
     * @ORM\ManyToOne(targetEntity="TransmissionType")
     * @ORM\JoinColumn(name="transmission_type", referencedColumnName="id", nullable=true)
     */
    private $transmissionType;

    /**
     * @var string Numer rejestracyjny
     *
     * @ORM\Column(name="registrationNmber", type="string", length=8)
     */
    private $registrationNumber;

    /**
     * @var integer Przebieg
     *
     * @ORM\Column(name="mileage", type="integer", nullable=true)
     */
    private $mileage;

    /**
     * @var string Opis
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Company Firma, do której samochód jest przypisany
     *
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * Metoda zwraca identyfikator
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Metoda ustawia markę
     *
     * @param string $make Marka
     *
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Metoda zwraca markę
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Metoda ustawia model
     *
     * @param string $model Model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Metoda zwraca model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Metoda ustawia rok produkcji
     *
     * @param \DateTime $year Rok produkcji
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Metoda zwraca rok produkcji
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Metoda ustawia vin
     *
     * @param string $vin Numer VIN
     *
     * @return Car
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Metoda zwraca vin
     *
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Metoda ustawia rodzaj silnika
     *
     * @param string $engine Rodzaj silnika
     *
     * @return Car
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Metoda zwraca rodzaj silnika
     *
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Metoda ustawia typ paliwa
     *
     * @param FuelType $fuelType Typ paliwa
     *
     * @return Car
     */
    public function setFuelType(FuelType $fuelType)
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    /**
     * Metoda zwraca typ paliwa
     *
     * @return FuelType
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Metoda ustawia typ skrzyni biegów
     *
     * @param TransmissionType $transmissionType Typ skrzyni biegów
     *
     * @return Car
     */
    public function setTransmissionType(TransmissionType $transmissionType)
    {
        $this->transmissionType = $transmissionType;

        return $this;
    }

    /**
     * Metoda zwraca typ skrzyni biegów
     *
     * @return TransmissionType
     */
    public function getTransmissionType()
    {
        return $this->transmissionType;
    }

    /**
     * Metoda zwraca numer rejestracyjny
     *
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Metoda ustawia numer rejestracyjny
     *
     * @param mixed $registrationNumber Numer rejestracyjny
     *
     * @return Car
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
        return $this;
    }

    /**
     * Metoda ustawia przebieg
     *
     * @param integer $mileage Przebieg
     *
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Metoda zwraca przebieg
     *
     * @return integer
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Metoda ustawia opis
     *
     * @param string $description Opis
     *
     * @return Car
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Metoda zwraca opis
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Metoda zwraca firmę, do którek samochód jest przypisany
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia firmę, do którek samochód jest przypisany
     *
     * @param Company $company Firma
     *
     * @return Car
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

}


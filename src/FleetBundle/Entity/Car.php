<?php

namespace FleetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Car
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=64)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="year", type="datetime", nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=20, nullable=true)
     */
    private $vin;

    /**
     * @var string
     *
     * @ORM\Column(name="engine", type="string", length=255, nullable=true)
     */
    private $engine;

    /**
     * @ORM\ManyToOne(targetEntity="FuelType")
     * @ORM\JoinColumn(name="fuel_type", referencedColumnName="id", nullable=true)
     */
    private $fuelType;

    /**
     * @ORM\ManyToOne(targetEntity="TransmissionType")
     * @ORM\JoinColumn(name="transmission_type", referencedColumnName="id", nullable=true)
     */
    private $transmissionType;

    /**
     * @var string
     *
     * @ORM\Column(name="registrationNmber", type="string", length=8)
     */
    private $registrationNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="mileage", type="integer", nullable=true)
     */
    private $mileage;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set make
     *
     * @param string $make
     *
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set year
     *
     * @param \DateTime $year
     *
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \DateTime
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set vin
     *
     * @param string $vin
     *
     * @return Car
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin
     *
     * @return string
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Set engine
     *
     * @param string $engine
     *
     * @return Car
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get engine
     *
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set fuelType
     *
     * @param FuelType $fuelType
     *
     * @return Car
     */
    public function setFuelType(FuelType $fuelType)
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    /**
     * Get fuelType
     *
     * @return FuelType
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Set transmission
     *
     * @param TransmissionType $transmissionType
     *
     * @return Car
     */
    public function setTransmissionType(TransmissionType $transmissionType)
    {
        $this->transmissionType = $transmissionType;

        return $this;
    }

    /**
     * Get transmissionType
     *
     * @return TransmissionType
     */
    public function getTransmissionType()
    {
        return $this->transmissionType;
    }

    /**
     * Get registrationNumber
     *
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * Set registrationNumber
     *
     * @param mixed $registrationNumber
     *
     * @return Car
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
        return $this;
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     *
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Car
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}


<?php

namespace CompanyBundle\Entity;

use ClientBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;
use FleetBundle\Entity\Car;
use SebastianBergmann\Money\Currency AS MoneyCurrency;
use SebastianBergmann\Money\Money;

/**
 * Freight
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Freight
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
     * @ORM\Column(name="number", type="string", length=64)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="startingPosition", referencedColumnName="id")
     */
    private $startingPosition;

    /**
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="origin", referencedColumnName="id")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="destination", referencedColumnName="id")
     */
    private $destination;

    /**
     * @var integer
     *
     * @ORM\Column(name="distance", type="integer", nullable=true)
     */
    private $distance;

    /**
     * @var integer
     *
     * @ORM\Column(name="distanceToOrigin", type="integer", nullable=true)
     */
    private $distanceToOrigin;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumn(name="driver", referencedColumnName="id")
     */
    private $driver;

    /**
     * @ORM\ManyToOne(targetEntity="\FleetBundle\Entity\Car")
     * @ORM\JoinColumn(name="car", referencedColumnName="id")
     */
    private $car;

    /**
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

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
     * Set number
     *
     * @param string $number
     *
     * @return Freight
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Freight
     */
    public function setStart(\DateTime$start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Freight
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get destination
     *
     * @return Point
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set destination
     *
     * @param Point $destination
     *
     * @return Freight
     */
    public function setDestination(Point $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * Get origin
     *
     * @return Point
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set origin
     *
     * @param Point $origin
     *
     * @return Freight
     */
    public function setOrigin(Point $origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * Get startingPosition
     *
     * @return Point
     */
    public function getStartingPosition()
    {
        return $this->startingPosition;
    }

    /**
     * Set startingPosition
     *
     * @param Point $startingPosition
     *
     * @return Freight
     */
    public function setStartingPosition(Point $startingPosition)
    {
        $this->startingPosition = $startingPosition;
        return $this;
    }

    /**
     * Set distance
     *
     * @param integer $distance
     *
     * @return Freight
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return integer
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set distanceToOrigin
     *
     * @param integer $distanceToOrigin
     *
     * @return Freight
     */
    public function setDistanceToOrigin($distanceToOrigin)
    {
        $this->distanceToOrigin = $distanceToOrigin;

        return $this;
    }

    /**
     * Get distanceToOrigin
     *
     * @return integer
     */
    public function getDistanceToOrigin()
    {
        return $this->distanceToOrigin;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param int $price
     *
     * @return Freight
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Set driver
     *
     * @param Employee $driver
     *
     * @return Freight
     */
    public function setDriver(Employee $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return Employee
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set car
     *
     * @param Car $car
     *
     * @return Freight
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set client
     *
     * @param Client $client
     *
     * @return Freight
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Freight
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

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set company
     *
     * @param Company $company
     *
     * @return CompanyFreight
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

}


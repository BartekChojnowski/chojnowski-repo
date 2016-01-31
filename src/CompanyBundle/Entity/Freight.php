<?php

namespace CompanyBundle\Entity;

use ClientBundle\Entity\Client;
use Doctrine\ORM\Mapping as ORM;
use FleetBundle\Entity\Car;
use SebastianBergmann\Money\Currency AS MoneyCurrency;
use SebastianBergmann\Money\Money;

/**
 * Klasa reprezentująca zlecenie
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class Freight
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
     * @var string Numer zlecenia
     *
     * @ORM\Column(name="number", type="string", length=64)
     */
    private $number;

    /**
     * @var \DateTime Data rozpoczęcia zlecenia
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime Data zakończenia zlecenia
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * Lokalizacja przed rozpoczęciem zlecenia
     *
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="startingPosition", referencedColumnName="id")
     */
    private $startingPosition;

    /**
     * Lokalizacja początkowa zlecenia
     *
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="origin", referencedColumnName="id")
     */
    private $origin;

    /**
     * Lokazlizacja końcowa zlecenia
     *
     * @ORM\ManyToOne(targetEntity="Point", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="destination", referencedColumnName="id")
     */
    private $destination;

    /**
     * @var integer Dystans zlecenia
     *
     * @ORM\Column(name="distance", type="integer", nullable=true)
     */
    private $distance;

    /**
     * @var integer Dystans do zlecenia
     *
     * @ORM\Column(name="distanceToOrigin", type="integer", nullable=true)
     */
    private $distanceToOrigin;

    /**
     * @var integer Stawka
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * Kierowca
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumn(name="driver", referencedColumnName="id")
     */
    private $driver;

    /**
     * Samochód
     *
     * @ORM\ManyToOne(targetEntity="\FleetBundle\Entity\Car")
     * @ORM\JoinColumn(name="car", referencedColumnName="id")
     */
    private $car;

    /**
     * Klient
     *
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var string Opis
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Company Firma, której dotyczy zlecenie
     *
     * @ORM\ManyToOne(targetEntity="Company")
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
     * Metoda ustawia numer zlecenia
     *
     * @param string $number Numer zlecenia
     *
     * @return Freight
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Metoda zwraca numer zlecenia
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Metoda ustawia datę rozpoczęcia zlecenia
     *
     * @param \DateTime $start Data rozpoczęcia zlecenia
     *
     * @return Freight
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Metoda zwraca datę rozpoczęcia zlecenia
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Metoda ustawia datę zakończenia zlecenia
     *
     * @param \DateTime $end Data zakończenia zlecenia
     *
     * @return Freight
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Metoda zwraca datę zakończenia zlecenia
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Metoda zwraca lokazlizację końcową zlecenia
     *
     * @return Point
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Metoda ustawia lokazlizację końcową zlecenia
     *
     * @param Point $destination Lokazlizacja końcowa zlecenia
     *
     * @return Freight
     */
    public function setDestination(Point $destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * Metoda zwraca lokazlizację początkową zlecenia
     *
     * @return Point
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Metoda ustawia lokazlizację początkową zlecenia
     *
     * @param Point $origin Lokalizacja początkowa zlecenia
     *
     * @return Freight
     */
    public function setOrigin(Point $origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * Metoda zwraca lokazlizację przed rozpoczęciem zlecenia
     *
     * @return Point
     */
    public function getStartingPosition()
    {
        return $this->startingPosition;
    }

    /**
     * Metoda ustawia lokazlizację przed rozpoczęciem zlecenia
     *
     * @param Point $startingPosition Lokalizacja przed rozpoczęciem zlecenia
     *
     * @return Freight
     */
    public function setStartingPosition(Point $startingPosition)
    {
        $this->startingPosition = $startingPosition;
        return $this;
    }

    /**
     * Metoda ustawia dystans zlecenia
     *
     * @param integer $distance Dystans zlecenia
     *
     * @return Freight
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Metoda zwraca dystans zlecenia
     *
     * @return integer
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Metoda ustawia dystans do zlecenia
     *
     * @param integer $distanceToOrigin Dystans do zlecenia
     *
     * @return Freight
     */
    public function setDistanceToOrigin($distanceToOrigin)
    {
        $this->distanceToOrigin = $distanceToOrigin;

        return $this;
    }

    /**
     * Metoda zwraca dystans do zlecenia
     *
     * @return integer
     */
    public function getDistanceToOrigin()
    {
        return $this->distanceToOrigin;
    }

    /**
     * Metoda zwraca stawkę
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Metoda ustawia stawkę
     *
     * @param int $price Stawka
     *
     * @return Freight
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Metoda ustawia kierowcę
     *
     * @param Employee $driver Kierowca
     *
     * @return Freight
     */
    public function setDriver(Employee $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Metoda zwraca kierowcę
     *
     * @return Employee
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Metoda ustawia samochód
     *
     * @param Car $car Samochód
     *
     * @return Freight
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Metoda zwraca samochód
     *
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Metoda ustawia klienta
     *
     * @param Client $client Klient
     *
     * @return Freight
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Metoda zwraca klienta
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Metoda ustawia opis
     *
     * @param string $description Opis
     *
     * @return Freight
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
     * Metoda zwraca firmę, której dotyczy zlecenie
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia firmę, której dotyczy zlecenie
     *
     * @param Company $company Firma, której dotyczy zlecenie
     *
     * @return CompanyFreight
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

}


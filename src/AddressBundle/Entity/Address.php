<?php

namespace AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nadrzędna klasa reprezentująca adres
 *
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="subject", type="string")
 * @ORM\DiscriminatorMap({"employee" = "EmployeeAddress", "company" = "CompanyAddress", "client" = "ClientAddress"})
 */
abstract class Address
{
    /**
     * @var integer Identyfikator
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string Miasto
     *
     * @ORM\Column(name="city", type="string", length=120, nullable=true)
     */
    protected $city;

    /**
     * @var string Kod pocztowy
     *
     * @ORM\Column(name="postcode", type="string", length=20, nullable=true)
     */
    protected $postcode;

    /**
     * @var string Ulica
     *
     * @ORM\Column(name="street", type="string", length=120, nullable=true)
     */
    protected $street;

    /**
     * @var string Numer domu
     *
     * @ORM\Column(name="number", type="string", length=15, nullable=true)
     */
    protected $number;


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
     * Metoda ustawia
     *
     * @param string $city Miasto
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Metoda zwraca miasto
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Metoda ustawia kod pocztowy
     *
     * @param string $postcode Kod pocztowy
     *
     * @return Address
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Metoda zwraca kod pocztowy
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Metoda ustawia ulicę
     *
     * @param string $street Ulica
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Metoda zwraca ulicę
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Metoda ustawia numer domu
     *
     * @param string $number Numer domu
     *
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Metoda zwraca numer domu
     *
     * @return string Numer domu
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Metoda zwraca podmiot, którego dotyczy adres
     */
    abstract public function getSubject();
}


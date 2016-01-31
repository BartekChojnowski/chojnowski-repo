<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentująca lokalizację
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class Point
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
     * @var string Szerokość geograficzna
     *
     * @ORM\Column(name="latitude", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $latitude;

    /**
     * @var string Długość geograficzna
     *
     * @ORM\Column(name="longitude", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $longitude;

    /**
     * @var string Adres
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;


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
     * Metoda ustawia szerokość geograficzną
     *
     * @param string $latitude Szerokość geograficzna
     *
     * @return Point
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Metoda zwraca szerokość geograficzną
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Metoda ustawia długość geograficzną
     *
     * @param string $longitude Długość geograficzna
     *
     * @return Point
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Metoda zwraca długość geograficzną
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Metoda ustawia adres
     *
     * @param string $address Adres
     *
     * @return Point
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Metoda zwraca adres
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}


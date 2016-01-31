<?php

namespace CompanyBundle\Entity;

use AddressBundle\Entity\CompanyAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentująca firmę
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class Company
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
     * @var string Nazwa
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string NIP
     *
     * @ORM\Column(name="taxId", type="string", length=16)
     */
    protected $taxId;

    /**
     * @var string Email
     *
     * @ORM\Column(name="email", type="string", length=80)
     */
    protected $email;

    /**
     * @var ArrayCollection Adresy
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\CompanyAddress", mappedBy="company")
     **/
    protected $addresses;

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

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
     * Metoda ustawia nazwę
     *
     * @param string $name Nazwa
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Metoda zwraca nazwę
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Metoda ustawia NIP
     *
     * @param string $taxId NIP
     *
     * @return Company
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Metoda zwraca NIP
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Metoda zwraca email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Metoda ustawia email
     *
     * @param string $email Email
     *
     * @return Company
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Metoda zwraca adresy
     *
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Metoda ustawia adresy
     *
     * @param ArrayCollection $addresses Kolekcja adresów
     *
     * @return Company
     */
    public function setAddresses(ArrayCollection $addresses)
    {
        $this->$addresses = $addresses;

        return $this;
    }

    /**
     * Metoda dodaje adres do kolekcji
     *
     * @param CompanyAddress $address Adres
     *
     * @return Company
     */
    public function addAddress(CompanyAddress $address)
    {
        $this->addresses->add($address);

        return $this;
    }

    /**
     * Metoda usuwa adres z kolekcji
     *
     * @param CompanyAddress $address Adres
     *
     * @return Company
     */
    public function removeAddress(CompanyAddress $address)
    {
        $this->addresses->removeElement($address);

        return $this;
    }

}


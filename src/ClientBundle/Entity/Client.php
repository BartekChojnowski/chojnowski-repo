<?php

namespace ClientBundle\Entity;

use AddressBundle\Entity\ClientAddress;
use CompanyBundle\Entity\Company;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentująca klienta
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class Client
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
     * @var string Nazwa
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string NIP
     *
     * @ORM\Column(name="taxId", type="string", length=16, nullable=true)
     */
    private $taxId;

    /**
     * @var string Email
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=true)
     */
    private $email;

    /**
     * @var ArrayCollection Adresy
     *
     * @ORM\OneToMany(targetEntity="AddressBundle\Entity\ClientAddress", mappedBy="client")
     **/
    private $addresses;

    /**
     * @var string Opis
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Company Firma, której dotyczy klient
     *
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

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
     * @return Client
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
     * @return Client
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
     * @return Client
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * Metoda dodaje adres do kolekcji
     *
     * @param ClientAddress $address Adres
     *
     * @return Client
     */
    public function addAddress(ClientAddress $address)
    {
        $this->addresses->add($address);

        return $this;
    }

    /**
     * Metoda usuwa adres z kolekcji
     *
     * @param ClientAddress $address Adres
     *
     * @return Client
     */
    public function removeAddress(ClientAddress $address)
    {
        $this->addresses->removeElement($address);

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
     * Metoda ustawia opis
     *
     * @param string $description Opis
     *
     * @return Client
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Metoda zwraca firmę, której dotyczy klient
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia firmę, której dotyczy klient
     *
     * @param Company $company Firma
     *
     * @return CompanyFreight
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        return $this;
    }

}


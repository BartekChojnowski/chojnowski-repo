<?php

namespace AddressBundle\Entity;

use CompanyBundle\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentuje adres firmy
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CompanyAddress extends Address
{
    /**
     * Firma
     *
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $company;

    /**
     * Metoda zwraca klienta
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia klienta
     *
     * @param Company $company Klient
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Metoda zwraca podmiot, którego dotyczy adres
     *
     * @return Company
     */
    public function getSubject()
    {
        $this->getCompany();
    }
}


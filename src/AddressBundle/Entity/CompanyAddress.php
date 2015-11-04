<?php

namespace AddressBundle\Entity;

use CompanyBundle\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompanyAddress extends Address
{
    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $company;

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    }

    public function getSubject()
    {
        $this->getCompany();
    }
}


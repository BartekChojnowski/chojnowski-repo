<?php

namespace PhoneBundle\Entity;

use CompanyBundle\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyPhone
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompanyPhone extends Phone
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


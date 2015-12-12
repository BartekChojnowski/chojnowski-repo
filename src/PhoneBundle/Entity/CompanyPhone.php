<?php

namespace PhoneBundle\Entity;

use CompanyBundle\Entity\Company;
use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyPhone
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompanyPhone extends Phone
{
    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $company;

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
     * @return Company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get subject
     *
     * @return Company
     */
    public function getSubject()
    {
        $this->getCompany();
    }
}


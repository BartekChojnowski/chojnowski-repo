<?php

namespace AddressBundle\Entity;

use CompanyBundle\Entity\Employee;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeAddress
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EmployeeAddress extends Address
{
    /**
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Employee")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $employee;

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * @return Employee
     */
    public function getSubject()
    {
        $this->getEmployee();
    }
}


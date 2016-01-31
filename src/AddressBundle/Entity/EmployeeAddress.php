<?php

namespace AddressBundle\Entity;

use CompanyBundle\Entity\Employee;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentuje adres pracownika
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeAddress extends Address
{
    /**
     * Pracownik
     *
     * @ORM\ManyToOne(targetEntity="CompanyBundle\Entity\Employee")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     **/
    private $employee;

    /**
     * Metoda zwraca pracownika
     *
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Metoda ustawia pracownika
     *
     * @param Employee $employee Pracownik
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Metoda zwraca podmiot, którego dotyczy adres
     *
     * @return Employee
     */
    public function getSubject()
    {
        $this->getEmployee();
    }
}


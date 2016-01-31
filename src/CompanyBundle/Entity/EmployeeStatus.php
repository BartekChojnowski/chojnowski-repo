<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentująca status pracownika
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeStatus
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
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var string Nazwa systemowa
     *
     * @ORM\Column(name="systemName", type="string", length=80)
     */
    private $systemName;


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
     * @return EmployeeStatus
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
     * Metoda ustawia nazwę systemową
     *
     * @param string $systemName Nazwa systemowa
     *
     * @return EmployeeStatus
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;

        return $this;
    }

    /**
     * Metoda zwraca nazwę systemową
     *
     * @return string
     */
    public function getSystemName()
    {
        return $this->systemName;
    }
}


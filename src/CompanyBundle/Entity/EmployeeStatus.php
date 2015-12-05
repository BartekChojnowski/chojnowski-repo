<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmployeeStatus
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class EmployeeStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="systemName", type="string", length=80)
     */
    private $systemName;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return EmployeeStatus
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set systemName
     *
     * @param string $systemName
     *
     * @return EmployeeStatus
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;

        return $this;
    }

    /**
     * Get systemName
     *
     * @return string
     */
    public function getSystemName()
    {
        return $this->systemName;
    }
}

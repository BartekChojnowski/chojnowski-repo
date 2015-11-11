<?php

namespace PhoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 *
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="subject", type="string")
 * @ORM\DiscriminatorMap({"uset" = "UserPhone", "company" = "CompanyPhone", "client" = "ClientPhone"})
 */
abstract class Phone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=15)
     */
    protected $number;

    /**
     * @ORM\ManyToOne(targetEntity="PhoneType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     **/
    protected $type;

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
     * Set number
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return PhoneType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param PhoneType $type
     */
    public function setType(PhoneType $type)
    {
        $this->type = $type;
    }

    abstract public function getSubject();
}


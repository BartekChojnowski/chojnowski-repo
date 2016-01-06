<?php

namespace CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyFreight
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompanyFreight
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
     * @var integer
     *
     * @ORM\Column(name="company", type="integer")
     */
    private $company;

    /**
     * @var integer
     *
     * @ORM\Column(name="freight", type="integer")
     */
    private $freight;


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
     * Set company
     *
     * @param integer $company
     *
     * @return CompanyFreight
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return integer
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set freight
     *
     * @param integer $freight
     *
     * @return CompanyFreight
     */
    public function setFreight($freight)
    {
        $this->freight = $freight;

        return $this;
    }

    /**
     * Get freight
     *
     * @return integer
     */
    public function getFreight()
    {
        return $this->freight;
    }
}


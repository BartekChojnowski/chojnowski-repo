<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use CompanyBundle\Entity\Company;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Klasa reprezentuje konto użytkownika w systemie
 *
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * Identyfikator
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Firma, z którą konto jest związane
     *
     * @ORM\OneToOne(targetEntity="CompanyBundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     **/
    protected $company;

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
     * Metoda zwraca firmę, z którą konto jest związane
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Metoda ustawia firmę, z którą konto jest związane
     *
     * @param Company $company Firma
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
    }
}
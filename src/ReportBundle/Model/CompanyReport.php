<?php

namespace ReportBundle\Model;

use CompanyBundle\Entity\Company;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;

/**
 * Nadrzędna klasa reprezentująca raport generowany dla konkretnej firmy
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class CompanyReport extends Report
{
    /**
     * @var Company Firma, dla której generowany jest rapory
     */
    private $company;

    /**
     * Konstruktor
     *
     * @param Company $company Firma, dla której generowany jest rapory
     * @param EntityManager $em
     */
    function __construct(Company $company, EntityManager $em)
    {
        parent::__construct($em);
        $this->company = $company;
    }

    /**
     * Metoda zwraca firmę, dla której generowany jest rapory
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
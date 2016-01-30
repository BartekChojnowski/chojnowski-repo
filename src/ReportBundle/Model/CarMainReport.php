<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use CompanyBundle\Entity\Company;
use Doctrine\ORM\EntityManager;

/**
 * Class CarMainReport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CarMainReport extends Report
{
    /**
     * @var Company
     */
    private $company;

    function __construct(Company $company, EntityManager $em)
    {
        parent::__construct($em);
        $this->company = $company;
    }

    /**
     * Returns report query
     *
     * @return string
     */
    private function getQuery()
    {
        return '
            SELECT
                C.id AS carId,
                CONCAT(C.registrationNmber," ",C.make," ",C.model) AS car,
                COUNT(F.id) AS freightCount,
                SUM(F.distance) AS distanceSum,
                AVG(F.distance) AS distanceSumAverage,
                SUM(F.distanceToOrigin) AS distanceToOriginSum,
                AVG(F.distanceToOrigin) AS distanceToOriginAverage
            FROM
                car C
                JOIN freight F ON C.id = F.car

            WHERE
                C.company_id = '.$this->company->getId().'
            GROUP BY
                C.id
            ORDER BY C.id
        ';
    }

    /**
     * Returns report query
     *
     * @return Query
     */
    public function getResults()
    {
        $stmt = $this->em->getConnection()->prepare($this->getQuery());
        $stmt->execute();


        return $stmt->fetchAll();
    }




} 
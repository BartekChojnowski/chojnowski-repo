<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use CompanyBundle\Entity\Company;
use Doctrine\ORM\EntityManager;

/**
 * Class ClientMainReport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class ClientMainReport extends Report
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
                C.id AS clientId,
                C.name AS CLIENT,
                COUNT(F.id) AS freightCount,
                SUM(F.distance) AS distanceSum,
                AVG(F.distance) AS distanceSumAverage,
                SUM(F.price) AS priceSum,
                AVG(F.price) AS priceAverage
            FROM
                `client` C
                JOIN freight F ON C.id = F.client

            WHERE
                C.company_id = '.$this->company->getId().'
            GROUP BY
                C.id
            ORDER BY freightCount DESC
            LIMIT 20
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
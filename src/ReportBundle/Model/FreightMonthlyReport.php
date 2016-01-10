<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use CompanyBundle\Entity\Company;
use Doctrine\ORM\EntityManager;

/**
 * Class FreightMonthlyReport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightMonthlyReport extends Report
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
                YEAR(F.start) AS year
                ,MONTH(F.start) AS monthId
                ,M.month AS month
                ,COUNT(*) AS freightCount
                ,SUM(F.distance) AS distanceSum
                ,AVG(F.distance) AS distanceAverage
                ,SUM(F.distanceToOrigin) AS distanceToOriginSum
                ,AVG(F.distanceToOrigin) AS distanceToOriginAverage
                ,SUM(F.price) AS priceSum
                ,AVG(F.price) AS priceAverage
            FROM
                freight F
                JOIN __months M ON M.id = MONTH(F.start)
            WHERE
                company_id = '.$this->company->getId().'
            GROUP BY
                YEAR(F.start), MONTH(F.start)
            ORDER BY
                YEAR(F.start) DESC, MONTH(F.start) ASC
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
        $results = array();

        foreach($stmt->fetchAll() as $result) {
            $results[$result['year']][] = $result;
        }

        return $results;
    }




} 
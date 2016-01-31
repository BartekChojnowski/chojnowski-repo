<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;

/**
 * Class FreightMonthlyReport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightMonthlyReport extends CompanyReport
{
    /**
     * Metoda zwraca zapytanie poberające wyniki do raportu
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
                company_id = '.$this->getCompany()->getId().'
            GROUP BY
                YEAR(F.start), MONTH(F.start)
            ORDER BY
                YEAR(F.start) DESC, MONTH(F.start) ASC
        ';
    }

    /**
     * Metoda zwraca wyniki raportu
     *
     * @return Query
     */
    public function getResults()
    {
        $stmt = $this->getEntityManager()->getConnection()->prepare($this->getQuery());
        $stmt->execute();
        $results = array();

        foreach($stmt->fetchAll() as $result) {
            $results[$result['year']][] = $result;
        }

        return $results;
    }
}
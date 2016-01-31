<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;

/**
 * Klasa reprezentująca ogólny raport samochodów
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CarMainReport extends CompanyReport
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
                C.company_id = '.$this->getCompany()->getId().'
            GROUP BY
                C.id
            ORDER BY C.id
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

        return $stmt->fetchAll();
    }

}
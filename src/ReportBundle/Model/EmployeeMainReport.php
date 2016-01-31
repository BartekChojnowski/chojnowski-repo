<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;

/**
 * Klasa reprezentująca ogólny raport pracowników
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeMainReport extends CompanyReport
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
                E.id AS employeeId,
                CONCAT (E.lastName," ",E.firstName) AS employee,
                COUNT(F.id) AS freightCount,
                SUM(F.distance) AS distanceSum,
                AVG(F.distance) AS distanceSumAverage,
                SUM(F.distanceToOrigin) AS distanceToOriginSum,
                AVG(F.distanceToOrigin) AS distanceToOriginAverage
            FROM
                employee E
                JOIN freight F ON E.id = F.driver

            WHERE
                E.company_id = '.$this->getCompany()->getId().'
            GROUP BY
                E.id
            ORDER BY E.lastName, E.firstName
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
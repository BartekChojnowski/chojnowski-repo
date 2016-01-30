<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use CompanyBundle\Entity\Company;
use Doctrine\ORM\EntityManager;

/**
 * Class EmployeeMainReport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeMainReport extends Report
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
                E.company_id = '.$this->company->getId().'
            GROUP BY
                E.id
            ORDER BY E.lastName, E.firstName
        ';
    }

    /**
     * Returns report query
     *
     * @return array
     */
    public function getResults()
    {
        $stmt = $this->em->getConnection()->prepare($this->getQuery());
        $stmt->execute();


        return $stmt->fetchAll();
    }
}
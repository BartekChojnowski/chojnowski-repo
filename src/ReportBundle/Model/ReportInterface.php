<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;

/**
 * Interfejs dla klas raportów
 *
 * @package ReportBundle\Model
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface ReportInterface
{

    /**
     * Metoda zwraca wyniki raportu
     *
     * @return Query
     */
    public function getResults();
}
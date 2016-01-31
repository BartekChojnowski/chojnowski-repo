<?php

namespace ReportBundle\Utils\Chart;

use ReportBundle\Model\Report;

/**
 * Interfejs dla klas wykresów
 *
 * @package ReportBundle\Utils\Chart
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface ChartInterface {

    /**
     * Metoda zwraca wygenerowany wykres
     *
     * @param Report $report
     *
     * @return string
     */
    public function render(Report $report);
}
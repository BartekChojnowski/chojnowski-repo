<?php

namespace ReportBundle\Utils\Chart\Freight\Monthly;

use Khill\Lavacharts\Configs\DataTable;
use Khill\Lavacharts\Lavacharts;
use ReportBundle\Model\Report;
use ReportBundle\Utils\Chart\MonthlyChart;

/**
 * Klasa reprezentuje wykres przejechanych kilometrów na dany miesiąc w roku
 *
 * @package ReportBundle\Utils\Chart\Freight\Monthly
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class DistanceChart extends MonthlyChart{

    /**
     * Konstruktor
     *
     * @param Lavacharts $lava Obiekt generujący wykres
     * @param string $name Unikalna nazwa wykresu
     * @param string $caption Nagłówek wykresu
     * @param int $year Rok, dla którego generowany jest wykres
     */
    public function __construct(Lavacharts $lava, $name, $caption, $year)
    {
        parent::__construct($lava, $name, $caption, $year);

        # ustawienie typu wykresu
        $this->chart = $lava->BarChart($this->getCaption());
    }

    /**
     * Metoda zwraca wygenerowany wykres
     *
     * @param Report $report
     *
     * @return string
     */
    public function render(Report $report)
    {
        # przygotowanie wykresu
        $this->chart
            ->height(300)
            ->datatable($this->dataTable($report))
        ;

        return $this->chart->render($this->getName());
    }

    /**
     * Metoda przygotowuje dane do wykresu
     *
     * @param Report $report
     *
     * @return DataTable
     */
    private function dataTable(Report $report)
    {
        /** @var DataTable $table */
        $table = $this->lava->DataTable();

        # ustawienie nagłówków
        $table
            ->addStringColumn('Miesiąc')
            ->addNumberColumn('Przejechanych kilometrów')
            ->addNumberColumn('Dojazd')
        ;

        # przygotowanie wierszy
        foreach ($report->getResults()[$this->getYear()] as $result) {
            $table->addRow(array($result['month'], $result['distanceSum'], $result['distanceToOriginSum']));
        }

        return $table;
    }
}
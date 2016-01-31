<?php

namespace ReportBundle\Utils\Chart\Car\Main;

use Khill\Lavacharts\Configs\DataTable;
use Khill\Lavacharts\Lavacharts;
use ReportBundle\Model\Report;
use ReportBundle\Utils\Chart\Chart;

/**
 * Klasa reprezentuje wykres przejechanych kilometrów
 *
 * @package ReportBundle\Utils\Chart\Car\Main
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class DistanceChart extends Chart
{

    /**
     * Konstruktor
     *
     * @param Lavacharts $lava Obiekt generujący wykres
     * @param string $name Unikalna nazwa wykresu
     * @param string $caption Nagłówek wykresu
     */
    public function __construct(Lavacharts $lava, $name, $caption)
    {
        parent::__construct($lava, $name, $caption);

        # ustawienie typu wykresu
        $this->chart = $lava->BarChart($caption);
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
        $this->chart->height(200)->datatable($this->dataTable($report));

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
        $table->addStringColumn('Samochód')->addNumberColumn('Przejechanych kilometrów');

        # przygotowanie wierszy
        foreach ($report->getResults() as $result) {
            $table->addRow(array($result['car'], $result['distanceSum']));
        }

        return $table;
    }
}
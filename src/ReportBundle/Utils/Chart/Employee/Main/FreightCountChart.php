<?php

namespace ReportBundle\Utils\Chart\Employee\Main;

use Khill\Lavacharts\Configs\DataTable;
use Khill\Lavacharts\Lavacharts;
use ReportBundle\Model\Report;
use ReportBundle\Utils\Chart\Chart;

/**
 * Klasa reprezentuje wykres z ilością wykonanych zleceń
 *
 * @package ReportBundle\Utils\Chart\Employee\Main
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightCountChart extends Chart{

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
        $this->chart
            ->height(500)
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
            ->addStringColumn('Pracownik')
            ->addNumberColumn('Ilość zleceń')
        ;

        # przygotowanie wierszy
        foreach ($report->getResults() as $result) {
            $table->addRow(array($result['employee'], (int)$result['freightCount']));
        }

        return $table;
    }

}
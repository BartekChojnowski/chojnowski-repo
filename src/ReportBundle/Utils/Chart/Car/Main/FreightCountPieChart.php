<?php

namespace ReportBundle\Utils\Chart\Car\Main;

use Khill\Lavacharts\Configs\DataTable;
use Khill\Lavacharts\Lavacharts;
use ReportBundle\Model\Report;
use ReportBundle\Utils\Chart\Chart;

/**
 * Klasa reprezentuje wykres kołowy z ilością wykonanych zleceń
 *
 * @package ReportBundle\Utils\Chart\Car\Main
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightCountPieChart extends Chart{

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
        $this->chart = $lava->PieChart($caption);
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
            ->height(400)
            ->datatable($this->dataTable($report))
            ->setOptions(array(
                'title' => 'Stosunek ilości wykonanych zleceń',
                'is3D' => true,
            ));

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
            $table->addRow(array($result['car'], (int)$result['freightCount']));
        }

        return $table;
    }

}
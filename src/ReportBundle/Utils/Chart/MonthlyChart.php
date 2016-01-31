<?php

namespace ReportBundle\Utils\Chart;

use Khill\Lavacharts\Lavacharts;

/**
 * Klasa reprezentuje wykres sum stawek za zlecenia na dany miesiąc w roku
 *
 * @package ReportBundle\Utils\Chart\Freight\Monthly
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class MonthlyChart extends Chart{

    /**
     * @var int Rok, dla którego generowany jest wykres
     */
    protected $year;

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
        parent::__construct($lava, $name, $caption);

        # ustawienie typu wykresu
        $this->chart = $lava->BarChart($caption);
        $this->year = $year;
    }

    /**
     * Metoda zwraca rok, dla którego generowany jest wykres
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Metoda zwraca unikalną nazwę wykresu
     *
     * @return srting
     */
    public function getName()
    {
        return parent::getName().'-'.$this->getYear();
    }

    /**
     * Metoda zwraca nagłówek wykresu
     *
     * @return srting
     */
    public function getCaption()
    {
        return parent::getCaption().'-'.$this->getYear();
    }
}
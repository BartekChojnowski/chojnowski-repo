<?php

namespace ReportBundle\Utils\Chart;

use Khill\Lavacharts\Lavacharts;

/**
 * Nadrzędna klasa reprezentująca wykres
 *
 * @package ReportBundle\Utils\Chart\Employee
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class Chart implements ChartInterface
{
    /**
     * @var Lavacharts Obiekt generujący wykres
     */
    protected $lava;

    /**
     * @var \Khill\Lavacharts\Charts\Chart Obiekt wykresu z biblioteki Lavacharts
     */
    protected $chart;

    /**
     * @var string Unikalna nazwa wykresu
     */
    protected $name;

    /**
     * @var string Nagłówek wykresu
     */
    protected $caption;

    /**
     * Konstruktor
     *
     * @param Lavacharts $lava Obiekt generujący wykres
     * @param string $name Unikalna nazwa wykresu
     * @param string $caption Nagłówek wykresu
     */
    public function __construct(Lavacharts $lava, $name, $caption)
    {
        $this->lava = $lava;
        $this->name = $name;
        $this->caption = $caption;
    }

    /**
     * Metoda zwraca unikalną nazwę wykresu
     *
     * @return srting
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Metoda zwraca nagłówek wykresu
     *
     * @return srting
     */
    public function getCaption()
    {
        return $this->caption;
    }
}
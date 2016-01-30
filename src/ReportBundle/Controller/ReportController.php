<?php

namespace ReportBundle\Controller;

use Khill\Lavacharts\Lavacharts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ReportController
 * @package ReportBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class ReportController extends Controller
{
    /**
     * @var Lavacharts Obiekt generujący wykres
     */
    protected $lava;

    /**
     * Konstruktor
     */
    function __construct()
    {
        $this->lava =  new Lavacharts();
    }

    /**
     * Metoda zwraca obiekt generujący wykres
     *
     * @return Lavacharts
     */
    public function getLava()
    {
        return $this->lava;
    }


}

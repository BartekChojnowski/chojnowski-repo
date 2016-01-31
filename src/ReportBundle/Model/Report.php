<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;

/**
 * Nadrzędna klasa reprezentująca raport
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class Report implements ReportInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Konstruktor
     *
     * @param EntityManager $em
     */
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Metoda zwraca obiekt Entity Manager'a
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
}
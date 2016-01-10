<?php

namespace ReportBundle\Model;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;

/**
 * Class Report
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class Report
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    function __construct(EntityManager$em)
    {
        $this->em = $em;
    }

    /**
     * Returns report results
     *
     * @return Query
     */
    abstract public function getResults();

} 
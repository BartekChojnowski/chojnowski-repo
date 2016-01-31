<?php

namespace PaginationBundle\Util;

use Doctrine\ORM\EntityManager;
use PaginationBundle\View\TableFactoryInterface;

/**
 * Abstrakcyjna klasa schematu tabeli postronicowanej
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
abstract class AbstractPaginatedTableScheme implements PaginatedTableSchemeInterface
{
    /**
     * @var PaginatedTableFactory Fabryka elementów tabeli
     */
    protected $tableFactory;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Konstruktor
     *
     * @param TableFactoryInterface $tableFactory
     * @param EntityManager $entityManager
     */
    public function __construct(TableFactoryInterface $tableFactory, EntityManager $entityManager)
    {
        $this->tableFactory = $tableFactory;
        $this->entityManager = $entityManager;
    }
}

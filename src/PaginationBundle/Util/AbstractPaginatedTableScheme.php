<?php

namespace PaginationBundle\Util;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Abstrakcyjna klasa schematu tabeli postronicowanej
 *
 * @author CB <b.chojnowski@kredyty-chwilowki.pl>
 */
abstract class AbstractPaginatedTableScheme
{
    /**
     * Główna metoda zajmująca się budowaniem tabeli
     *
     * @param ArrayCollection $rows
     * @param array $objects
     * @param array $additionalData
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return mixed
     */
    abstract public function buildTable(ArrayCollection $rows, $objects, $additionalData = null);
}

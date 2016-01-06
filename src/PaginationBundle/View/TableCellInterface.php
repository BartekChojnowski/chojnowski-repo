<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla komórek tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author CB
 */
interface TableCellInterface
{
    /**
     * Pobierz wartość elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getValue();

    /**
     * Ustawia wartosc w elemencie html
     *
     * @param string $value
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableCellInterface
     */
    public function setValue($value);

}
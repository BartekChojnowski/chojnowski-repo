<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla komórek tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface TableCellInterface
{
    /**
     * Pobierz wartość elementu html
     *
     * @return string
     */
    public function getValue();

    /**
     * Ustawia wartosc w elemencie html
     *
     * @param string $value
     *
     * @return TableCellInterface
     */
    public function setValue($value);

}
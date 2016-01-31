<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla fabryki elementów tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface TableFactoryInterface
{
    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @return TableRowInterface
     */
    public function getRowInstance();

    /**
     * Metoda zwraca instancje klasy komórki w tabeli stronicowania
     *
     * @return TableCellInterface
     */
    public function getCellInstance();

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania
     *
     * @return TableCellInterface
     */
    public function getHeaderCellInstance();

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @return TableRowInterface
     */
    public function getHeaderRowInstance();
}
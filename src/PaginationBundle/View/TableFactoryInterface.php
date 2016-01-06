<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla fabryki elementów tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author CB
 */
interface TableFactoryInterface
{
    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableRowInterface
     */
    public function getRowInstance();

    /**
     * Metoda zwraca instancje klasy komórki w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableCellInterface
     */
    public function getCellInstance();

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableCellInterface
     */
    public function getHeaderCellInstance();

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableRowInterface
     */
    public function getHeaderRowInstance();
}
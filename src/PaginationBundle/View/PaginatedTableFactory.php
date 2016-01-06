<?php

namespace PaginationBundle\View;

/**
 * Fabryka tworząca instancje obiektów do tabeli z wynikami stronicowania
 *
 * @author CB <b.chojnowski@kredyty-chwilowki.pl>
 */
class PaginatedTableFactory implements TableFactoryInterface
{
    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function getRowInstance()
    {
        return new PaginatedTableRow();
    }

    /**
     * Metoda zwraca instancje klasy komórki w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableCell
     */
    public function getCellInstance()
    {
        return new PaginatedTableCell();
    }

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableHeaderCell
     */
    public function getHeaderCellInstance()
    {
        return new PaginatedTableHeaderCell();
    }

    /**
     * Metoda zwraca instancje klasy nagłówka w tabeli stronicowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableHeaderRow
     */
    public function getHeaderRowInstance()
    {
        return new PaginatedTableHeaderRow();
    }

    /**
     * Metoda zwraca instancje klasy nagłówka w tabeli stronicowania z chekboxem umożliwijącym zaznaczanie
     * wszystkich wierszy
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableHeaderWithCheckboxRow
     */
    public function getHeaderRowWithCheckboxInstance()
    {
        return new PaginatedTableHeaderWithCheckboxRow();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania z checkboxem umożliwiającym zaznaczenie
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRowWithCheckbox
     */
    public function getRowWithCheckboxInstance()
    {
        return new PaginatedTableRowWithCheckbox();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania z checkboxem umożliwiającym zaznaczenie
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableActionRow
     */
    public function getActionRowInstance()
    {
        return new PaginatedTableActionRow();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania oznaczającego brak wyników
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableActionRow
     */
    public function getNoResultsRowInstance()
    {
        return new PaginatedTableNoResultsRow();
    }

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania, po którym można sortować
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableSortableHeaderCell
     */
    public function getSortableHeaderCellInstance()
    {
        return new PaginatedTableSortableHeaderCell();
    }

}
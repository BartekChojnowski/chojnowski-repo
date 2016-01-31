<?php

namespace PaginationBundle\View;

/**
 * Fabryka tworząca instancje obiektów do tabeli z wynikami stronicowania
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableFactory implements TableFactoryInterface
{
    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania
     *
     * @return PaginatedTableRow
     */
    public function getRowInstance()
    {
        return new PaginatedTableRow();
    }

    /**
     * Metoda zwraca instancje klasy komórki w tabeli stronicowania
     *
     * @return PaginatedTableCell
     */
    public function getCellInstance()
    {
        return new PaginatedTableCell();
    }

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania
     *
     * @return PaginatedTableHeaderCell
     */
    public function getHeaderCellInstance()
    {
        return new PaginatedTableHeaderCell();
    }

    /**
     * Metoda zwraca instancje klasy nagłówka w tabeli stronicowania
     *
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
     * @return PaginatedTableHeaderWithCheckboxRow
     */
    public function getHeaderRowWithCheckboxInstance()
    {
        return new PaginatedTableHeaderWithCheckboxRow();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania z checkboxem umożliwiającym zaznaczenie
     *
     * @return PaginatedTableRowWithCheckbox
     */
    public function getRowWithCheckboxInstance()
    {
        return new PaginatedTableRowWithCheckbox();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania z checkboxem umożliwiającym zaznaczenie
     *
     * @return PaginatedTableActionRow
     */
    public function getActionRowInstance()
    {
        return new PaginatedTableActionRow();
    }

    /**
     * Metoda zwraca instancje klasy wiersza w tabeli stronicowania oznaczającego brak wyników
     *
     * @return PaginatedTableActionRow
     */
    public function getNoResultsRowInstance()
    {
        return new PaginatedTableNoResultsRow();
    }

    /**
     * Metoda zwraca instancje klasy komórki nagłówka w tabeli stronicowania, po którym można sortować
     *
     * @return PaginatedTableSortableHeaderCell
     */
    public function getSortableHeaderCellInstance()
    {
        return new PaginatedTableSortableHeaderCell();
    }

}
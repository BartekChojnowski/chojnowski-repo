<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca komórkę z nagłówka w postronicowanej tabeli
 *
 * @package PaginationBundle\View
 */
class PaginatedTableSortableHeaderCell extends PaginatedTableCell
{
    protected $template = 'PaginationBundle::sortable-header-cell.html.twig';

    /**
     * @var string Pole, po którym będzie sortowanie
     */
    protected $sort;

    /**
     * @var string Kierunek sortowania
     */
    protected $direction;

    /**
     * Pobierz pole, po którym będzie sortowanie
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Ustawia pole, po którym będzie sortowanie
     *
     * @param string $sort
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableHeaderCell
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Pobierz kierunek sortowania
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Ustawia kierunek sortowania
     *
     * @param string $direction
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableHeaderCell
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }
}
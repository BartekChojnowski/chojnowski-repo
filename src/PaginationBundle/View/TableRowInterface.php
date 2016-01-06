<?php

namespace PaginationBundle\View;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interfejs dla wierszy tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author CB
 */
interface TableRowInterface
{
    /**
     * Pobierz Cells
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return ArrayCollection
     */
    public function getCells();

    /**
     * Ustawia Cells
     *
     * @param ArrayCollection $cells
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableRowInterface
     */
    public function setCells(ArrayCollection $cells);
}
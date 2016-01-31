<?php

namespace PaginationBundle\View;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interfejs dla wierszy tablicy stronicowania.  Wymusza wymagane metody.
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface TableRowInterface
{
    /**
     * Pobierz Cells
     *
     * @return ArrayCollection
     */
    public function getCells();

    /**
     * Ustawia Cells
     *
     * @param ArrayCollection $cells
     *
     * @return TableRowInterface
     */
    public function setCells(ArrayCollection $cells);
}
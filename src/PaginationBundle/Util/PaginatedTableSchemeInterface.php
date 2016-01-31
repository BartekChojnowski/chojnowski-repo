<?php

namespace PaginationBundle\Util;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interfejs schematów tabel postronicowanych
 *
 * @package PaginationBundle\Util
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface PaginatedTableSchemeInterface {

    /**
     * Główna metoda zajmująca się budowaniem tabeli
     *
     * @param ArrayCollection $rows
     * @param array $objects
     * @param array $additionalData
     */
    public function buildTable(ArrayCollection $rows, $objects, $additionalData = null);
} 
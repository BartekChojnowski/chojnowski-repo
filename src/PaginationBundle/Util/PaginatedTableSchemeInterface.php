<?php

namespace PaginationBundle\Util;


use Doctrine\Common\Collections\ArrayCollection;

interface PaginatedTableSchemeInterface {

    /**
     * Główna metoda zajmująca się budowaniem tabeli
     *
     * @param ArrayCollection $rows
     * @param array $objects
     * @param array $additionalData
     *
     * @return mixed
     */
    public function buildTable(ArrayCollection $rows, $objects, $additionalData = null);
} 
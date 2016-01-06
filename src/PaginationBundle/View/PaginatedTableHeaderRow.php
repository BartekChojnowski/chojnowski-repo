<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz nagłówka w postronicowanej tabeli
 *
 * @package PaginationBundle\View
 */
class PaginatedTableHeaderRow extends PaginatedTableRow
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::header-row.html.twig';
}
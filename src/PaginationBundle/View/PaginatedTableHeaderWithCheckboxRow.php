<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz nagłówka w postronicowanej tabeli z dodatkowym checkboxem
 *
 * @package PaginationBundle\View
 */
class PaginatedTableHeaderWithCheckboxRow extends PaginatedTableHeaderRow
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::header-with-checkbox-row.html.twig';
}
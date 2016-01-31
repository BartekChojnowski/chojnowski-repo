<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz nagłówka w postronicowanej tabeli z dodatkowym checkboxem
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableHeaderWithCheckboxRow extends PaginatedTableHeaderRow
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::header-with-checkbox-row.html.twig';
}
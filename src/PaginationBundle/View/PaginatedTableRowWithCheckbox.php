<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz w postronicowanej tabeli z checkboxem umożliwiającym jego zaznaczenie
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableRowWithCheckbox extends PaginatedTableRow
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::row-with-checkbox.html.twig';
}
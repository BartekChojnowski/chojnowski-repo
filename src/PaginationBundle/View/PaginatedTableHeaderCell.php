<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca komórkę nagłówka w postronicowanej tabeli
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableHeaderCell extends PaginatedTableCell
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::header-cell.html.twig';
}
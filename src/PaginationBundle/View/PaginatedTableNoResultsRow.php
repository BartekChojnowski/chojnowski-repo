<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz w postronicowanej tabeli z informacją o braku wyników
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableNoResultsRow extends PaginatedTableRow
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::no-results-row.html.twig';
}
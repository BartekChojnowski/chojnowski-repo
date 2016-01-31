<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz w postronicowanej tabeli zawierający dodatkowe akcje
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableActionRow extends PaginatedTableRow
{
    /**
     * @var string Szablon wiersza
     */
    protected $template = 'PaginationBundle::action-row.html.twig';

    /**
     * @var array Tablica akcji
     */
    protected $groupActions;

    /**
     * Pobierz szablon
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Ustawia szablon
     *
     * @param string $template
     *
     * @return PaginatedTableActionRow
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Pobierz akcje
     *
     * @return array
     */
    public function getGroupActions()
    {
        return $this->groupActions;
    }

    /**
     * Ustawia akcje
     *
     * @param mixed $groupActions
     *
     * @return PaginatedTableActionRow
     */
    public function setGroupActions($groupActions)
    {
        $this->groupActions = $groupActions;

        return $this;
    }
}
<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca wiersz w postronicowanej tabeli zawierający dodatkowe akcje
 *
 * @package PaginationBundle\View
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
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
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
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
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
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
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
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableActionRow
     */
    public function setGroupActions($groupActions)
    {
        $this->groupActions = $groupActions;

        return $this;
    }
}
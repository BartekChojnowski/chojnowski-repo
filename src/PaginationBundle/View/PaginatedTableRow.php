<?php

namespace PaginationBundle\View;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Klasa reprezentująca wiersz w postronicowanej tabeli
 *
 * @package PaginationBundle\View
 */
class PaginatedTableRow implements TableElementInterface, TableRowInterface
{
    /**
     * @var string Szablon
     */
    protected $template = 'PaginationBundle::row.html.twig';

    /**
     * @var ArrayCollection Kolekcja komórek w wierszu
     */
    protected $cells;

    /**
     * @var string Styl elementu html
     */
    protected $style;

    /**
     * @var string Id elementu html
     */
    protected $id;

    /**
     * @var string Class elementu html
     */
    protected $class;

    /**
     * @var string Data elementu html
     */
    protected $data = array();

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->cells = new ArrayCollection();
    }

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
     * @return PaginatedTableRow
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Pobierz kolekcję komórek w wierszu
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return ArrayCollection
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Ustawia kolekcję komórek w wierszu
     *
     * @param ArrayCollection $cells
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function setCells(ArrayCollection $cells)
    {
        $this->cells = $cells;

        return $this;
    }

    /**
     * Pobierz styl elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Ustawia styl w elemencie html
     *
     * @param string $style
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Pobierz Id elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Ustawia Id w elemencie html
     *
     * @param string $id
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Pobierz Class elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Ustawia Class w elemencie html
     *
     * @param string $class
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Pobierz Data elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Ustawia Data w elemencie html
     *
     * @param array $data
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return PaginatedTableRow
     */
    public function setData($data)
    {
        $this->data = (array)$data;

        return $this;
    }
}
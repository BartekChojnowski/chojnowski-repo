<?php

namespace PaginationBundle\View;

/**
 * Klasa reprezentująca komórkę w postronicowanej tabeli
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTableCell implements TableElementInterface, TableCellInterface
{
    /**
     * @var string Sablon
     */
    protected $template = 'PaginationBundle::cell.html.twig';

    /**
     * @var string Wartość w komórce
     */
    protected $value;

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
     * @var string Colspan elementu html
     */
    protected $colspan;

    /**
     * @var string Rowspan elementu html
     */
    protected $rowspan;

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
     * @return PaginatedTableCell
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Pobierz styl elementu html
     *
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
     * @return PaginatedTableCell
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Pobierz wartość elementu html
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Ustawia wartosc w elemencie html
     *
     * @param string $value
     *
     * @return PaginatedTableCell
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Pobierz Id elementu html
     *
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
     * @return PaginatedTableCell
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Pobierz Class elementu html
     *
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
     * @return PaginatedTableCell
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Pobierz Data elementu html
     *
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
     * @return PaginatedTableCell
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Pobierz Colspan elementu html
     *
     * @return string
     */
    public function getColspan()
    {
        return $this->colspan;
    }

    /**
     * Ustawia Colspan w elemencie html
     *
     * @param string $colspan
     *
     * @return PaginatedTableCell
     */
    public function setColspan($colspan)
    {
        $this->colspan = $colspan;

        return $this;
    }

    /**
     * Pobierz Rowspan elementu html
     *
     * @return string
     */
    public function getRowspan()
    {
        return $this->rowspan;
    }

    /**
     * Ustawia Rowspan w elemencie html
     *
     * @param string $rowspan
     *
     * @return PaginatedTableCell
     */
    public function setRowspan($rowspan)
    {
        $this->rowspan = $rowspan;

        return $this;
    }


}
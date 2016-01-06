<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla elementów tablicy stronicowania. Wymusza wymagane metody.
 *
 * @author CB
 */
interface TableElementInterface
{
    /**
     * Pobierz szablon
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getTemplate();

    /**
     * Ustawia szablon
     *
     * @param string $template
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableElementInterface
     */
    public function setTemplate($template);

    /**
     * Pobierz styl elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getStyle();

    /**
     * Ustawia styl w elemencie html
     *
     * @param string $style
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableElementInterface
     */
    public function setStyle($style);

    /**
     * Pobierz Id elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getId();

    /**
     * Ustawia Id elementu html
     *
     * @param string $id
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableElementInterface
     */
    public function setId($id);

    /**
     * Pobierz Class elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getClass();

    /**
     * Ustawia Class w elemencie html
     *
     * @param string $class
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableElementInterface
     */
    public function setClass($class);

    /**
     * Pobierz Data elementu html
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return array
     */
    public function getData();

    /**
     * Ustawia Data w elemencie html
     *
     * @param array $data
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return TableElementInterface
     */
    public function setData($data);
}
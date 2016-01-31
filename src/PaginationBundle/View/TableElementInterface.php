<?php

namespace PaginationBundle\View;

/**
 * Interfejs dla elementów tablicy stronicowania. Wymusza wymagane metody.
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
interface TableElementInterface
{
    /**
     * Pobierz szablon
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Ustawia szablon
     *
     * @param string $template
     *
     * @return TableElementInterface
     */
    public function setTemplate($template);

    /**
     * Pobierz styl elementu html
     *
     * @return string
     */
    public function getStyle();

    /**
     * Ustawia styl w elemencie html
     *
     * @param string $style
     *
     * @return TableElementInterface
     */
    public function setStyle($style);

    /**
     * Pobierz Id elementu html
     *
     * @return string
     */
    public function getId();

    /**
     * Ustawia Id elementu html
     *
     * @param string $id
     *
     * @return TableElementInterface
     */
    public function setId($id);

    /**
     * Pobierz Class elementu html
     *
     * @return string
     */
    public function getClass();

    /**
     * Ustawia Class w elemencie html
     *
     * @param string $class
     *
     * @return TableElementInterface
     */
    public function setClass($class);

    /**
     * Pobierz Data elementu html
     *
     * @return array
     */
    public function getData();

    /**
     * Ustawia Data w elemencie html
     *
     * @param array $data
     *
     * @return TableElementInterface
     */
    public function setData($data);
}
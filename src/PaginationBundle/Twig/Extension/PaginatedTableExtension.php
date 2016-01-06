<?php

namespace PaginationBundle\Twig\Extension;


use PaginationBundle\View\PaginatedTable;

/**
 * Class PaginatedTableExtension
 * @package PaginationBundle\Twig\Extension
 */
class PaginatedTableExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * {@inheritDoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Metoda zwraca funkcje zdefinowane w rozszerzeniu
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'paginatedTableRender' => new \Twig_Function_Method($this, 'paginatedTableRender', array('is_safe' => array('html'))),
        );
    }

    /**
     * Metoda zajmuje się wyrenderowaniem tabeli stronicownia
     *
     * @param PaginatedTable $paginatedTable
     * @param null $template
     *
     * @return string
     */
    public function paginatedTableRender(PaginatedTable $paginatedTable, $template = null)
    {
        if ($paginatedTable->getPagination() == NULL) {
            $paginatedTable->paginate();
        }

        $paginatedTable->getScheme()->buildTable(
            $paginatedTable->getRows(),
            $paginatedTable->getPagination()->getItems(),
            $paginatedTable->getAdditionalData()
        );

        return $this->environment->render(
            $template ?: $paginatedTable->getTemplate(),
            array('paginatedTable' => $paginatedTable)
        );
    }

    /**
     * Nazwa rozszerzenia. Wymagana interfejsem.
     *
     * @author CB <b.chojnowski@kredyty-chwilowki.pl>
     * @return string
     */
    public function getName()
    {
        return 'paginatedTable';
    }
}

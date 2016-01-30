<?php

namespace ClientBundle\Utils;

use ClientBundle\Entity\Client;
use Doctrine\Common\Collections\ArrayCollection;
use PaginationBundle\Util\AbstractPaginatedTableScheme;
use PaginationBundle\View\PaginatedTableCell;
use PaginationBundle\View\PaginatedTableHeaderCell;

/**
 *
 *
 * @author CB <b.chojnowski@kredyty-chwilowki.pl>
 */
class ClientListTableScheme extends AbstractPaginatedTableScheme
{
    /**
     * Główna metoda zajmująca się budowaniem tabeli
     *
     * @param ArrayCollection $rows
     * @param array $objects
     * @param array $additionalData
     *
     * @return mixed
     */
    public function buildTable(ArrayCollection $rows, $objects, $additionalData = null)
    {
        # utworzenie nagłówka tabeli
        $this->buildTableHeader($rows);

        /** @var Client $object */
        foreach((array)$objects as $object) {
            $rows->add($this->buildTableRow($object));
        }
    }

    /**
     * Metoda zajmuje się utworzeniem wiersza w tabeli postronicowanej
     *
     * @param Client $client
     *
     * @return PaginatedTableRow
     */
    private function buildTableRow(Client $client)
    {
        # utworzenie wiersza i ustawienie odpowiednich parametrów
        $row = $this->tableFactory->getRowInstance();

        # Dodanie odpowiednich komórek do wiersza
        $row->getCells()->add($this->buildNameCell($client));
        $row->getCells()->add($this->buildTaxIdCell($client));
        $row->getCells()->add($this->buildEmailCell($client));
        $row->getCells()->add($this->buildActionsCell($client));

        return $row;
    }

    /**
     * Metoda zajmuje się budowaniem nagłówka tabeli
     *
     * @param ArrayCollection $rows
     */
    public function buildTableHeader(ArrayCollection $rows)
    {
        # dodanie wiersza nagłówka
        $rows->add($this->tableFactory->getHeaderRowInstance());

        $rows->current()->getCells()->add($this->buildNameHeaderCell());
        $rows->current()->getCells()->add($this->buildTaxIdHeaderCell());
        $rows->current()->getCells()->add($this->buildEmailHeaderCell());
        $rows->current()->getCells()->add($this->buildActionsHeaderCell());
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - nazwa
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildNameHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('nazwa')
            ->setClass('col-md-6')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - NIP
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildTaxIdHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('nip')
            ->setClass('col-md-2')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - email
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildEmailHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('email')
            ->setClass('col-md-2')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - akcje
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildActionsHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setClass('col-md-2')
            ;
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - nazwa
     *
     * @param Client $client
     *
     * @return PaginatedTableCell
     */
    private function buildNameCell(Client $client)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($client->getName())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - nip
     *
     * @param Client $client
     *
     * @return PaginatedTableCell
     */
    private function buildTaxIdCell(Client $client)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($client->getTaxId())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - email
     *
     * @param Client $client
     *
     * @return PaginatedTableCell
     */
    private function buildEmailCell(Client $client)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($client->getEmail())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - akcje
     *
     * @param Client $client
     *
     * @return PaginatedTableCell
     */
    private function buildActionsCell(Client $client)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setTemplate('ClientBundle:Client:client-list-actions-cell.html.twig')
            ->setValue($client)
        ;
    }
}

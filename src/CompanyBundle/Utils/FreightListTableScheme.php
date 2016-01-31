<?php

namespace CompanyBundle\Utils;

use CompanyBundle\Entity\Freight;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use PaginationBundle\Util\AbstractPaginatedTableScheme;
use PaginationBundle\View\PaginatedTableCell;
use PaginationBundle\View\PaginatedTableHeaderCell;
use PaginationBundle\View\TableFactoryInterface;

/**
 * Schemat postronicowanej tablicy zleceń
 *
 * @author CB <b.chojnowski@kredyty-chwilowki.pl>
 */
class FreightListTableScheme extends AbstractPaginatedTableScheme
{
    /**
     * Główna metoda zajmująca się budowaniem tabeli
     *
     * @param ArrayCollection $rows
     * @param array $objects
     * @param array $additionalData
     */
    public function buildTable(ArrayCollection $rows, $objects, $additionalData = null)
    {
        # utworzenie nagłówka tabeli
        $this->buildTableHeader($rows);

        # utworzenie wierszy tabeli
        /** @var Freight $object */
        foreach((array)$objects as $object) {
            $rows->add($this->buildTableRow($object));
        }
    }

    /**
     * Metoda zajmuje się utworzeniem wiersza w tabeli postronicowanej
     *
     * @param Freight $freight
     *
     * @return PaginatedTableRow
     */
    private function buildTableRow(Freight $freight)
    {
        # utworzenie wiersza i ustawienie odpowiednich parametrów
        $row = $this->tableFactory->getRowInstance();

        # Dodanie odpowiednich komórek do wiersza
        $row->getCells()->add($this->buildNumberCell($freight));
        $row->getCells()->add($this->buildStartTypeCell($freight));
        $row->getCells()->add($this->buildEndCell($freight));
        $row->getCells()->add($this->buildOriginCell($freight));
        $row->getCells()->add($this->buildDestinationCell($freight));
        $row->getCells()->add($this->buildDistanceCell($freight));
        $row->getCells()->add($this->buildDistanceToOriginCell($freight));
        $row->getCells()->add($this->buildPriceCell($freight));
        $row->getCells()->add($this->buildActionsCell($freight));

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

        # utworzenie komórek nagłówka
        $rows->current()->getCells()->add($this->buildNumberHeaderCell());
        $rows->current()->getCells()->add($this->buildStartHeaderCell());
        $rows->current()->getCells()->add($this->buildEndHeaderCell());
        $rows->current()->getCells()->add($this->buildOriginHeaderCell());
        $rows->current()->getCells()->add($this->buildDestinationHeaderCell());
        $rows->current()->getCells()->add($this->buildDistanceHeaderCell());
        $rows->current()->getCells()->add($this->buildDistanceToOriginHeaderCell());
        $rows->current()->getCells()->add($this->buildPriceHeaderCell());
        $rows->current()->getCells()->add($this->buildActionsHeaderCell());
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - numer
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildNumberHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('numer')
            ->setClass('col-md-1')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - data od
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildStartHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('data od')
            ->setClass('col-md-1')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - data do
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildEndHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('data do')
            ->setClass('col-md-1')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - skąd
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildOriginHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('skąd')
            ->setClass('col-md-2')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - dokąd
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildDestinationHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('dokąd')
            ->setClass('col-md-2')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - odległość
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildDistanceHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('odległość')
            ->setClass('col-md-1')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - odległość do zlecenia
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildDistanceToOriginHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('do zlecenia')
            ->setClass('col-md-1')
            ;
    }

    /**
     * Metoda buduje i zwraca komórkę nagłówka - stawka
     *
     * @return PaginatedTableHeaderCell
     */
    private function buildPriceHeaderCell()
    {
        return $this->tableFactory
            ->getHeaderCellInstance()
            ->setValue('stawka')
            ->setClass('col-md-1')
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
     * Metoda zwraca przygotowaną komórkę - numer
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildNumberCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getNumber())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - data od
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildStartTypeCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getStart()->format('Y-m-d'))
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - data do
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildEndCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getEnd()->format('Y-m-d'))
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - skąd
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildOriginCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getOrigin()->getAddress())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - dokąd
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildDestinationCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getDestination()->getAddress())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - odległość
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildDistanceCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getDistance())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - odległość do zlecenia
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildDistanceToOriginCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getDistanceToOrigin())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - stawka
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildPriceCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setValue($freight->getPrice())
        ;
    }

    /**
     * Metoda zwraca przygotowaną komórkę - akcje
     *
     * @param Freight $freight Zlecenie
     *
     * @return PaginatedTableCell
     */
    private function buildActionsCell(Freight $freight)
    {
        return $this
            ->tableFactory->getCellInstance()
            ->setTemplate('CompanyBundle:Freight:freight-list-actions-cell.html.twig')
            ->setValue($freight)
        ;
    }
}

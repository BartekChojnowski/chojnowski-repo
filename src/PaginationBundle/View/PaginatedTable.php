<?php

namespace PaginationBundle\View;

use Doctrine\Common\Collections\ArrayCollection;
use PaginationBundle\Util\AbstractPaginatedTableScheme;
use Knp\Component\Pager\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tabela postronicowana
 *
 * @package PaginationBundle\View
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class PaginatedTable
{
    /**
     * @var string Szablon tabeli
     */
    protected $template = 'PaginationBundle::table.html.twig';

    /**
     * @var string Nagłówek tabeli
     */
    protected $title;

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var mixed Obiekt, który będzie stronicowany
     */
    protected $target;

    /**
     * @var int Aktualna strona
     */
    protected $page = 1;

    /**
     * @var array Dane przekazywane przy operacjach stronicowania
     */
    protected $postData = array();

    /**
     * @var string Route, jaki jest wykorzystywany przy operacjach stronicowania
     */
    protected $route;

    /**
     * @var string Unikalny identyfikator postronicowanej tabeli
     */
    protected $identifier = 'paginatedTable';

    /**
     * @var int Ilość wyników na stronie
     */
    protected $resultsOnPage = 25;

    /**
     * @var SlidingPagination Stronicowanie
     */
    protected $pagination;

    /**
     * @var AbstractPaginatedTableScheme Schemat tabeli
     */
    protected $scheme;

    /**
     * @var ArrayCollection Kolekcja wierszy w tabeli
     */
    protected $rows;

    /**
     * @var array Dodatkowe dane, jakie można przekazać do postronicowanej tabeli
     */
    protected $additionalData;

    /**
     * Konstroktor
     *
     * @param $paginator
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
        $this->rows = new ArrayCollection();
    }

    /**
     * Pobierz obiekt, który będzie stronicowany
     *
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Ustawia obiekt, który będzie stronicowany
     *
     * @param mixed $target
     *
     * @return PaginatedTable
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Pobierz kolekcję wierszy w tabeli
     *
     * @return ArrayCollection
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Ustawia Rows
     *
     * @param mixed $rows
     *
     * @return PaginatedTable
     */
    public function setRows(ArrayCollection $rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * Pobierz nagłówek tabeli
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Ustawia nagłówek tabeli
     *
     * @param mixed $title
     *
     * @return PaginatedTable
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Pobierz aktualną stronę
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Ustawia aktualną stronę
     *
     * @param int $page
     *
     * @return PaginatedTable
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Pobierz dane przekazywane przy operacjach stronicowania
     *
     * @return array
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * Ustawia dane przekazywane przy operacjach stronicowania
     *
     * @param array $postData
     *
     * @return PaginatedTable
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;
        return $this;
    }

    /**
     * Pobierz Route, jaki jest wykorzystywany przy operacjach stronicowania
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Ustawia Route, jaki jest wykorzystywany przy operacjach stronicowania
     *
     * @param mixed $route
     *
     * @return PaginatedTable
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * Pobierz identyfikator
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Ustawia identyfikator
     *
     * @param string $identifier
     *
     * @return PaginatedTable
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Pobierz Request
     *
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Ustawia Request
     *
     * @param mixed $request
     *
     * @return PaginatedTable
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Pobierz ilość wyników na stronie
     *
     * @return int
     */
    public function getResultsOnPage()
    {
        return $this->resultsOnPage;
    }

    /**
     * Pobierz szablon tabeli
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Ustawia szablon tabeli
     *
     * @param string $template
     *
     * @return PaginatedTable
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Pobierz stronicowanie
     *
     * @return mixed
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Pobierz Paginator
     *
     * @return mixed
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * Ustawia Paginator
     *
     * @param mixed $paginator
     *
     * @return PaginatedTable
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;

        return $this;
    }

    /**
     * Pobierz Scheme
     *
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Ustawia Scheme
     *
     * @param AbstractPaginatedTableScheme $scheme
     *
     * @return PaginatedTable
     */
    public function setScheme(AbstractPaginatedTableScheme $scheme)
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * Ustawia ilość wyników na stronie
     *
     * @param int $resultsOnPage
     *
     * @return PaginatedTable
     */
    public function setResultsOnPage($resultsOnPage)
    {
        $this->resultsOnPage = $resultsOnPage;

        return $this;
    }

    /**
     * Metoda zajmuje się przygotowaniem stronicowania
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface|SlidingPagination
     */
    public function paginate()
    {
        # Ustawiam obiekt stronicowania odpowiednimi parametrami
        $this->pagination = $this->paginator->paginate(
            $this->target,
            $this->request->request->get('page', 1),
            $this->request->request->get('resultsOnPage', $this->resultsOnPage),
            array(
                'identifier' => $this->identifier,
                'postData' => $this->request->request->all(),
            )
        );

        # ustawiam lokalizację jaka będzie używana przez stronicowanie
        if (isset($this->route)) {
            $this->pagination->setUsedRoute($this->route);
        }

        return $this->pagination;
    }

    /**
     * Pobierz dodatkowe dane, jakie można przekazać do postronicowanej tabeli
     *
     * @return mixed
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * Ustawia dodatkowe dane, jakie można przekazać do postronicowanej tabeli
     *
     * @param mixed $additionalData
     *
     * @return PaginatedTable
     */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;

        return $this;
    }
}
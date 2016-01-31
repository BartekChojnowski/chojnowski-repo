<?php

namespace CompanyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Główny kontroler dla firmy
 *
 * @package CompanyBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class MainController extends Controller
{
    /**
     * Domyślna akcja. Zwraca panel zarządzania firmą
     *
     * @Route("/company", name="company")
     */
    public function indexAction(Request $request)
    {
        return $this->render('CompanyBundle::homepage.html.twig', array());
    }
}

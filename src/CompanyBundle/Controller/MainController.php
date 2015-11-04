<?php

namespace CompanyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/company", name="company")
     */
    public function indexAction(Request $request)
    {
            return $this->render('CompanyBundle::homepage.html.twig', array());
    }
}

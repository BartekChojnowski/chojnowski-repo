<?php

namespace ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class MainController
 * @package ReportBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 * @Route("/report")
 */
class MainController extends Controller
{
    /**
     * Report main page.
     *
     * @Route("/", name="report")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}

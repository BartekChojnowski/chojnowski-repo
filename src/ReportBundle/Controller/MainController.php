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
//        $request = $this->getRequest();
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getManager();
//
//        $freights = $em->getRepository('CompanyBundle:Freight')->findAll();
//        /** @var PaginatedTable $paginatedTable */
//        $paginatedTable = $this->get('pagination.paginated_table');
//        $paginatedTable
//            ->setTitle('')
//            ->setScheme(new FreightListTableScheme(new PaginatedTableFactory(), $em))
//            ->setTarget($freights)
//            ->setRequest($request)
//            ->setRoute('freight')
//            ->setIdentifier('freightListTable')
//        ;
//
//        # W zależności od tego czy żądanie było AJAX-owe czy nie zwracam odpowiedni widok
//        if ($request->isXmlHttpRequest()) {
//            # dla żadania AJAX-owego zwracam tylko tabele z wynikam
//            return $this->render('CompanyBundle:Freight:freight-list.html.twig', array(
//                'paginatedTable' => $paginatedTable,
//            ));
//        } else {
//            # widok całej strony
//            return array(
//                'freights' => $freights,
//                'paginatedTable' => $paginatedTable,
//            );
//        }
        return array(
//            'freights' => $freights,
        );
    }
}

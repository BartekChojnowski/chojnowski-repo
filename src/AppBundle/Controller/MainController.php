<?php

namespace AppBundle\Controller;

use CompanyBundle\Entity\Company;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Główny kontroler aplikacji
 *
 * @package AppBundle\Controller
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class MainController extends Controller
{
    /**
     * Domyślna akcja. Wyświetlenie strony głównej
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        # w zależności od tego czy użytkownik jest zalogowany wyświetlane są rózne strony
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            if ($this->getUser()->getCompany() instanceof Company) {
                return $this->forward('CompanyBundle:Main:index');
            } else {
                return $this->forward('AppBundle:Main:newUserPage');
            }
        } else {
            return $this->render('AppBundle::homepage.html.twig', array());
        }
    }

    /**
     * Wyświetlenie panelu nowego użytkownika
     *
     * @Route("/newUser", name="new_user")
     */
    public function newUserPageAction(Request $request)
    {
        return $this->render('AppBundle::new-user-page.html.twig', array());
    }
}

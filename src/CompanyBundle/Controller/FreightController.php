<?php

namespace CompanyBundle\Controller;

use AddressBundle\Entity\ClientAddress;
use ClientBundle\Entity\Client;
use Doctrine\ORM\EntityManager;
use CompanyBundle\Utils\FreightListTableScheme;
use Ivory\GoogleMapBundle\Entity\Map;
use PaginationBundle\View\PaginatedTable;
use PaginationBundle\View\PaginatedTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CompanyBundle\Entity\Freight;
use CompanyBundle\Form\FreightType;
use CompanyBundle\Dictionary;

/**
 * Kontroler odpowiedzialny za akcje związane z zleceniami
 *
 * @Route("/freight")
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class FreightController extends Controller
{

    /**
     * Domyślna akcja. Wyświetlenie wszystkich zleceń
     *
     * @Route("/", name="freight")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie wszystkich zleceń firmy
        $freights = $em->getRepository('CompanyBundle:Freight')->findByCompany($this->getUser()->getCompany());

        # przygotowanie stronicowania wyników
        /** @var PaginatedTable $paginatedTable */
        $paginatedTable = $this->get('pagination.paginated_table');
        $paginatedTable
            ->setTitle('')
            ->setScheme(new FreightListTableScheme(new PaginatedTableFactory(), $em))
            ->setTarget($freights)
            ->setRequest($request)
            ->setRoute('freight')
            ->setIdentifier('freightListTable');

        # W zależności od tego czy żądanie było AJAX-owe czy nie zwracam odpowiedni widok
        if ($request->isXmlHttpRequest()) {
            # dla żadania AJAX-owego zwracam tylko tabele z wynikam
            return $this->render('CompanyBundle:Freight:freight-list.html.twig', array(
                'paginatedTable' => $paginatedTable,
            ));
        } else {
            # widok całej strony
            return array(
                'freights' => $freights,
                'paginatedTable' => $paginatedTable,
            );
        }
    }

    /**
     * Zapisanie nowego zlecenia
     *
     * @Route("/create", name="freight_create")
     * @Method("POST")
     * @Template("CompanyBundle:Freight:new.html.twig")
     */
    public function createAction(Request $request)
    {
        # utworzenie nowego obiektu zlecenia
        $freight = new Freight();
        $freight->setCompany($this->getUser()->getCompany());
        $client = new Client();
        $client->addAddress(new ClientAddress());
        $freight->setClient($client);
        # przetworzenie formularza
        $form = $this->createCreateForm($freight);
        $form->handleRequest($request);

        # walidacja formularza
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($freight);

            $em->persist($freight->getClient());
            $em->flush();

            # wyświetlenie danych nowego zlecenia
            return $this->redirect($this->generateUrl('freight_show', array('id' => $freight->getId())));
        }

        return array(
            'freight' => $freight,
            'form' => $form->createView(),
        );
    }

    /**
     * Metoda zwraca formularz nowego zlecenia
     *
     * @param Freight $freight Zlecenie
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Freight $freight)
    {
        # utworzenie formularza
        $form = $this->createForm(new FreightType(), $freight, array(
            'action' => $this->generateUrl('freight_create'),
            'method' => 'POST',
        ));

        # ustawienie przycisku "Zapisz"
        $form->add('submit', 'submit', array(
            'label' => 'Dodaj',
            'attr' => array('class' => 'btn btn-success btn-block')
        ));

        return $form;
    }

    /**
     * Wyświetlenie formularza nowego zlecenia
     *
     * @Route("/new", name="freight_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        # utworzenie nowego obiektu
        $freight = new Freight();
        $client = new Client();
        $client->addAddress(new ClientAddress());
        $freight->setClient($client);

        # przygotowanie obiektów google maps
        /** @var Map */
        $map = $this->get('ivory_google_map.map');
//        $geocoder = $this->get('ivory_google_map.geocoder');
//
//        $response = $geocoder->geocode('Bielsko-Biała');
//
//        foreach($response->getResults() as $result)
//        {
//            // Request the google map merker service
//            $marker = $this->get('ivory_google_map.marker');
//
//            // Position the marker
//            $marker->setPosition($result->getGeometry()->getLocation());
//
//            // Add the marker to the map
//            $map->addMarker($marker);
//        }

        #przygotowanie formularza
        $form = $this->createCreateForm($freight);

        return array(
            'freight' => $freight,
            'map' => $map,
            'form' => $form->createView(),
        );
    }

    /**
     * Wyświetlenie informacji konkretnego zlecenia
     *
     * @Route("/{id}", name="freight_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie zlecenia
        $freight = $em->getRepository('CompanyBundle:Freight')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$freight) {
            throw $this->createNotFoundException('Nie udało się znaleźć zlecenia.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'freight' => $freight,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Wyświetlenie formularza edycji istniejącego zlecenia
     *
     * @Route("/{id}/edit", name="freight_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie zlecenia
        $freight = $em->getRepository('CompanyBundle:Freight')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$freight) {
            throw $this->createNotFoundException('Nie udało się znaleźć zlecenia.');
        }

        # przygotowanie formularzy
        $editForm = $this->createEditForm($freight);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'freight' => $freight,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Metoda zwraca formularz edycji istniejącego zlecenia
     *
     * @param Freight $freight Zlecenie
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Freight $freight)
    {
        # utworzenie formularza
        $form = $this->createForm(new FreightType(), $freight, array(
            'action' => $this->generateUrl('freight_update', array('id' => $freight->getId())),
            'method' => 'PUT',
        ));

        # ustawienie przycisku "Zapisz"
        $form->add('submit', 'submit', array(
            'label' => 'Zapisz',
            'attr' => array(
                'class' => 'btn-success btn-block'
            )
        ));

        return $form;
    }

    /**
     * Zapisanie zmian w istniejącym zleceniu
     *
     * @Route("/{id}", name="freight_update")
     * @Method("PUT")
     * @Template("CompanyBundle:Freight:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie zlecenia
        $freight = $em->getRepository('CompanyBundle:Freight')->find($id);

        if (!$freight) {
            throw $this->createNotFoundException('Nie udało się znaleźć zlecenia.');
        }

        # utworzenie formularzy
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($freight);
        $editForm->handleRequest($request);

        # walidacja formularza
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('freight_edit', array('id' => $id)));
        }

        return array(
            'freight' => $freight,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Usunięcie zlecenia
     *
     * @Route("/{id}", name="freight_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $freight = $em->getRepository('CompanyBundle:Freight')->find($id);

            if (!$freight) {
                throw $this->createNotFoundException('Nie udało się znaleźć zlecenia.');
            }

            $em->remove($freight);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('freight'));
    }

    /**
     * Metoda zwraca formularz służacy do usuwania zlecenia
     *
     * @param mixed $id The freight id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('freight_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Usuń',
                'attr' => array(
                    'class' => 'btn-danger btn-block'
                )
            ))
            ->getForm();
    }
}

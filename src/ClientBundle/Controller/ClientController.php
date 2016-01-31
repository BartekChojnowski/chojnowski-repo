<?php

namespace ClientBundle\Controller;

use AddressBundle\Entity\ClientAddress;
use ClientBundle\Utils\ClientListTableScheme;
use Doctrine\ORM\EntityManager;
use PaginationBundle\View\PaginatedTable;
use PaginationBundle\View\PaginatedTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ClientBundle\Entity\Client;
use ClientBundle\Form\ClientType;

/**
 * Kontroler odpowiedzialny za akcje związane z klientami
 *
 * @Route("/client")
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class ClientController extends Controller
{

    /**
     * Domyślna akcja. Wyświetlenie wszystkich klientów
     *
     * @Route("/", name="client")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie wszystkich klientów firmy
        $clients = $em->getRepository('ClientBundle:Client')->findByCompany($this->getUser()->getCompany());

        # przygotowanie stronicowania wyników
        /** @var PaginatedTable $paginatedTable */
        $paginatedTable = $this->get('pagination.paginated_table');
        $paginatedTable
            ->setTitle('')
            ->setScheme(new ClientListTableScheme(new PaginatedTableFactory(), $em))
            ->setTarget($clients)
            ->setRequest($request)
            ->setRoute('client')
            ->setIdentifier('clientListTable');

        # W zależności od tego czy żądanie było AJAX-owe czy nie zwracam odpowiedni widok
        if ($request->isXmlHttpRequest()) {
            # dla żadania AJAX-owego zwracam tylko tabele z wynikam
            return $this->render('ClientBundle:Client:client-list.html.twig', array(
                'paginatedTable' => $paginatedTable,
            ));
        } else {
            # widok całej strony
            return array(
                'clients' => $clients,
                'paginatedTable' => $paginatedTable,
            );
        }
    }

    /**
     * Zapisanie nowego klienta
     *
     * @Route("/", name="client_create")
     * @Method("POST")
     * @Template("ClientBundle:Client:new.html.twig")
     */
    public function createAction(Request $request)
    {
        # utworzenie nowego obiektu klienta
        $client = new Client();
        $client->setCompany($this->getUser()->getCompany());
        # przetworzenie formularza
        $form = $this->createCreateForm($client);
        $form->handleRequest($request);

        # walidacja formularza
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);

            # zapisanie wszystkich adresów klienta
            /** @var ClientAddress $address */
            foreach ($client->getAddresses() as $address) {
                $address->setClient($client);
                $em->persist($address);
            }

            $em->flush();

            # wyświetlenie danych nowego klienta
            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }

        return array(
            'client' => $client,
            'form' => $form->createView(),
        );
    }

    /**
     * Metoda zwraca formularz nowego klienta
     *
     * @param Client $client Klient
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Client $client)
    {
        # utworzenie formularza
        $form = $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('client_create'),
            'method' => 'POST',
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
     * Wyświetlenie formularza nowego klienta
     *
     * @Route("/new", name="client_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        # utworzenie nowego obiektu
        $client = new Client();
        $client->addAddress(new ClientAddress());
        #przygotowanie formularza
        $form = $this->createCreateForm($client);

        return array(
            'client' => $client,
            'form' => $form->createView(),
        );
    }

    /**
     * Wyświetlenie informacji konkretnego klienta
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        # pobranie klienta
        $client = $em->getRepository('ClientBundle:Client')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$client) {
            throw $this->createNotFoundException('Nie znaleziono klienta.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Wyświetlenie formularza edycji istniejącego klienta
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        # pobranie klienta
        $client = $em->getRepository('ClientBundle:Client')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$client) {
            throw $this->createNotFoundException('Nie udało się znaleźć klienta.');
        }

        # przygotowanie formularzy
        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Metoda zwraca formularz edycji istniejącego klienta
     *
     * @param Client $client Klient
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Client $client)
    {
        # utworzenie formularza
        $form = $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('client_update', array('id' => $client->getId())),
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
     * Zapisanie zmian u istniejącego klienta
     *
     * @Route("/{id}", name="client_update")
     * @Method("PUT")
     * @Template("ClientBundle:Client:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        # pobranie klienta
        $client = $em->getRepository('ClientBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Nie udało się znaleźć klienta.');
        }

        # utworzenie formularzy
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($client);
        $editForm->handleRequest($request);

        # walidacja formularza
        if ($editForm->isValid()) {
            # zapisanie wszystkich adresów klienta
            /** @var ClientAddress $address */
            foreach ($client->getAddresses() as $address) {
                $address->setClient($client);
                $em->persist($address);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('client_edit', array('id' => $id)));
        }

        return array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Usunięcie klienta
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client = $em->getRepository('ClientBundle:Client')->find($id);

            if (!$client) {
                throw $this->createNotFoundException('Nie udało się znaleźć klienta.');
            }

            $em->remove($client);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('client'));
    }

    /**
     * Metoda zwraca formularz służacy do usuwania klienta
     *
     * @param mixed $id The client id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}

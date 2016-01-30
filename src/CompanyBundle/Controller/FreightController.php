<?php

namespace CompanyBundle\Controller;

use AddressBundle\Entity\ClientAddress;
use ClientBundle\Entity\Client;
use CompanyBundle\Entity\Currency;
use Doctrine\ORM\EntityManager;
use CompanyBundle\Utils\FreightListTableScheme;
use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;
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
 * Freight controller.
 *
 * @Route("/freight")
 */
class FreightController extends Controller
{

    /**
     * Lists all Freight entities.
     *
     * @Route("/", name="freight")
     * @Template()
     */
    public function indexAction(Request $request)
    {
//        $request = $this->getRequest();
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $freights = $em->getRepository('CompanyBundle:Freight')->findByCompany($this->getUser()->getCompany());

        /** @var PaginatedTable $paginatedTable */
        $paginatedTable = $this->get('pagination.paginated_table');
        $paginatedTable
            ->setTitle('')
            ->setScheme(new FreightListTableScheme(new PaginatedTableFactory(), $em))
            ->setTarget($freights)
            ->setRequest($request)
            ->setRoute('freight')
            ->setIdentifier('freightListTable')
        ;

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
     * Creates a new Freight entity.
     *
     * @Route("/create", name="freight_create")
     * @Method("POST")
     * @Template("CompanyBundle:Freight:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $freight = new Freight();
        $freight->setCompany($this->getUser()->getCompany());
        $client = new Client();
        $client->addAddress(new ClientAddress());
        $freight->setClient($client);
        $form = $this->createCreateForm($freight);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($freight);

            $em->persist($freight->getClient());
            $em->flush();

            return $this->redirect($this->generateUrl('freight_show', array('id' => $freight->getId())));
        }

        return array(
            'freight' => $freight,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Freight entity.
     *
     * @param Freight $freight
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Freight $freight)
    {
        $form = $this->createForm(new FreightType(), $freight, array(
            'action' => $this->generateUrl('freight_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Dodaj',
            'attr' => array('class' => 'btn btn-success btn-block')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Freight entity.
     *
     * @Route("/new", name="freight_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $freight = new Freight();
        $client = new Client();
        $client->addAddress(new ClientAddress());
        $freight->setClient($client);

        /** @var Map */
        $map = $this->get('ivory_google_map.map');

        $geocoder = $this->get('ivory_google_map.geocoder');

        $response = $geocoder->geocode('Bielsko-Biała');

        foreach($response->getResults() as $result)
        {
            // Request the google map merker service
            $marker = $this->get('ivory_google_map.marker');

            // Position the marker
            $marker->setPosition($result->getGeometry()->getLocation());

            // Add the marker to the map
            $map->addMarker($marker);
        }

        $form   = $this->createCreateForm($freight);

        return array(
            'freight' => $freight,
            'map' => $map,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Freight entity.
     *
     * @Route("/{id}", name="freight_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $freight = $em->getRepository('CompanyBundle:Freight')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$freight) {
            throw $this->createNotFoundException('Unable to find Freight entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'freight'      => $freight,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Freight entity.
     *
     * @Route("/{id}/edit", name="freight_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $freight = $em->getRepository('CompanyBundle:Freight')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$freight) {
            throw $this->createNotFoundException('Unable to find Freight entity.');
        }

        $editForm = $this->createEditForm($freight);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'freight'      => $freight,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Freight entity.
    *
    * @param Freight $freight
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Freight $freight)
    {
        $form = $this->createForm(new FreightType(), $freight, array(
            'action' => $this->generateUrl('freight_update', array('id' => $freight->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Zapisz',
            'attr' => array(
                'class' => 'btn-success btn-block'
            )
        ));

        return $form;
    }
    /**
     * Edits an existing Freight entity.
     *
     * @Route("/{id}", name="freight_update")
     * @Method("PUT")
     * @Template("CompanyBundle:Freight:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $freight = $em->getRepository('CompanyBundle:Freight')->find($id);

        if (!$freight) {
            throw $this->createNotFoundException('Unable to find Freight entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($freight);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('freight_edit', array('id' => $id)));
        }

        return array(
            'freight'      => $freight,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Freight entity.
     *
     * @Route("/{id}", name="freight_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $freight = $em->getRepository('CompanyBundle:Freight')->find($id);

            if (!$freight) {
                throw $this->createNotFoundException('Unable to find Freight entity.');
            }

            $em->remove($freight);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('freight'));
    }

    /**
     * Creates a form to delete a Freight entity by id.
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
            ->getForm()
        ;
    }
}

<?php

namespace ClientBundle\Controller;

use AddressBundle\Entity\ClientAddress;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ClientBundle\Entity\Client;
use ClientBundle\Form\ClientType;

/**
 * Client controller.
 *
 * @Route("/client")
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     * @Route("/", name="client")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('ClientBundle:Client')->findAll();

        return array(
            'clients' => $clients,
        );
    }
    /**
     * Creates a new Client entity.
     *
     * @Route("/", name="client_create")
     * @Method("POST")
     * @Template("ClientBundle:Client:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $client = new Client();
        $form = $this->createCreateForm($client);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);

            /** @var ClientAddress $address */
            foreach ($client->getAddresses() as $address) {
                $address->setClient($client);
                $em->persist($address);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('client_show', array('id' => $client->getId())));
        }

        return array(
            'client' => $client,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Client entity.
     *
     * @param Client $client The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Client $client)
    {
        $form = $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('client_create'),
            'method' => 'POST',
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
     * Displays a form to create a new Client entity.
     *
     * @Route("/new", name="client_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $client = new Client();
        $client->addAddress(new ClientAddress());
        $form   = $this->createCreateForm($client);

        return array(
            'client' => $client,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('ClientBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'client'      => $client,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('ClientBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'client'      => $client,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Client entity.
    *
    * @param Client $client The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Client $client)
    {
        $form = $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('client_update', array('id' => $client->getId())),
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
     * Edits an existing Client entity.
     *
     * @Route("/{id}", name="client_update")
     * @Method("PUT")
     * @Template("ClientBundle:Client:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $client = $em->getRepository('ClientBundle:Client')->find($id);

        if (!$client) {
            throw $this->createNotFoundException('Unable to find Client entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($client);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var ClientAddress $address */
            foreach ($client->getAddresses() as $address) {
                $address->setClient($client);
                $em->persist($address);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('client_edit', array('id' => $id)));
        }

        return array(
            'client'      => $client,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Client entity.
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
                throw $this->createNotFoundException('Unable to find Client entity.');
            }

            $em->remove($client);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('client'));
    }

    /**
     * Creates a form to delete a Client entity by id.
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
            ->getForm()
        ;
    }
}

<?php

namespace FleetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FleetBundle\Entity\Car;
use FleetBundle\Form\CarType;

/**
 * Car controller.
 *
 * @Route("/car")
 */
class CarController extends Controller
{

    /**
     * Lists all Car entities.
     *
     * @Route("/", name="car")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cars = $em->getRepository('FleetBundle:Car')->findByCompany($this->getUser()->getCompany());

        return array(
            'cars' => $cars
        );
    }
    /**
     * Creates a new Car entity.
     *
     * @Route("/", name="car_create")
     * @Method("POST")
     * @Template("FleetBundle:Car:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $car = new Car();
        $car->setCompany($this->getUser()->getCompany());

        $form = $this->createCreateForm($car);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirect($this->generateUrl('car_show', array('id' => $car->getId())));
        }

        return array(
            'car' => $car,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Car entity.
     *
     * @param Car $car The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Car $car)
    {
        $form = $this->createForm(new CarType(), $car, array(
            'action' => $this->generateUrl('car_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Dodaj',
            'attr' => array('class' => 'btn btn-success btn-block')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Car entity.
     *
     * @Route("/new", name="car_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $car = new Car();
        $form   = $this->createCreateForm($car);

        return array(
            'car' => $car,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Car entity.
     *
     * @Route("/{id}", name="car_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('FleetBundle:Car')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$car) {
            throw $this->createNotFoundException('Unable to find Car entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'car'      => $car,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Car entity.
     *
     * @Route("/{id}/edit", name="car_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('FleetBundle:Car')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$car) {
            throw $this->createNotFoundException('Unable to find Car entity.');
        }

        $editForm = $this->createEditForm($car);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'car'      => $car,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Car entity.
    *
    * @param Car $car The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Car $car)
    {
        $form = $this->createForm(new CarType(), $car, array(
            'action' => $this->generateUrl('car_update', array('id' => $car->getId())),
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
     * Edits an existing Car entity.
     *
     * @Route("/{id}", name="car_update")
     * @Method("PUT")
     * @Template("FleetBundle:Car:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $car = $em->getRepository('FleetBundle:Car')->find($id);

        if (!$car) {
            throw $this->createNotFoundException('Unable to find Car entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($car);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('car_edit', array('id' => $id)));
        }

        return array(
            'car'      => $car,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Car entity.
     *
     * @Route("/{id}", name="car_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $car = $em->getRepository('FleetBundle:Car')->find($id);

            if (!$car) {
                throw $this->createNotFoundException('Unable to find Car entity.');
            }

            $em->remove($car);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('car'));
    }

    /**
     * Creates a form to delete a Car entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('car_delete', array('id' => $id)))
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

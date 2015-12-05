<?php

namespace CompanyBundle\Controller;

use AddressBundle\Entity\EmployeeAddress;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CompanyBundle\Entity\Employee;
use CompanyBundle\Form\EmployeeType;

/**
 * Employee controller.
 *
 * @Route("/employee")
 */
class EmployeeController extends Controller
{

    /**
     * Lists all Employee entities.
     *
     * @Route("/", name="employee")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CompanyBundle:Employee')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Employee entity.
     *
     * @Route("/", name="employee_create")
     * @Method("POST")
     * @Template("CompanyBundle:Employee:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createCreateForm($employee);
        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            if ($employee->getAddress() instanceof EmployeeAddress) {
                $employee->getAddress()->setUser($employee);
                $em->persist($employee->getAddress());
            }

            $em->persist($employee);
            $em->flush();

            return $this->redirect($this->generateUrl('employee_show', array('id' => $employee->getId())));
        }

        return array(
            'entity' => $employee,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Employee entity.
     *
     * @param Employee $employee The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Employee $employee)
    {
        $form = $this->createForm(new EmployeeType(), $employee, array(
            'action' => $this->generateUrl('employee_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Dodaj',
            'attr' => array('class' => 'btn btn-success btn-block')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Employee entity.
     *
     * @Route("/new", name="employee_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $employee = new Employee();
        $form   = $this->createCreateForm($employee);

        return array(
            'entity' => $employee,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Employee entity.
     *
     * @Route("/{id}", name="employee_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $employee = $em->getRepository('CompanyBundle:Employee')->find($id);

        if (!$employee) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $employee,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Employee entity.
     *
     * @Route("/{id}/edit", name="employee_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $employee = $em->getRepository('CompanyBundle:Employee')->find($id);

        if (!$employee) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $editForm = $this->createEditForm($employee);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $employee,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Employee entity.
    *
    * @param Employee $employee The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Employee $employee)
    {
        $form = $this->createForm(new EmployeeType(), $employee, array(
            'action' => $this->generateUrl('employee_update', array('id' => $employee->getId())),
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
     * Edits an existing Employee entity.
     *
     * @Route("/{id}", name="employee_update")
     * @Method("PUT")
     * @Template("CompanyBundle:Employee:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $employee = $em->getRepository('CompanyBundle:Employee')->find($id);

        if (!$employee) {
            throw $this->createNotFoundException('Unable to find Employee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($employee);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('employee_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $employee,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Employee entity.
     *
     * @Route("/{id}", name="employee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $employee = $em->getRepository('CompanyBundle:Employee')->find($id);

            if (!$employee) {
                throw $this->createNotFoundException('Unable to find Employee entity.');
            }

            $em->remove($employee);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employee'));
    }

    /**
     * Creates a form to delete a Employee entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employee_delete', array('id' => $id)))
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

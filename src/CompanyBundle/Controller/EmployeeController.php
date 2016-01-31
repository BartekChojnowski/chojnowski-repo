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
 * Kontroler odpowiedzialny za akcje związane z pracownikami
 *
 * @Route("/employee")
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class EmployeeController extends Controller
{

    /**
     * Domyślna akcja. Wyświetlenie wszystkich pracowników
     *
     * @Route("/", name="employee")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie wszystkich pracowników firmy
        $company = $this->getUser()->getCompany();
        $employees = $em->getRepository('CompanyBundle:Employee')->findByCompany($company);

        return array(
            'employees' => $employees,
        );
    }

    /**
     * Zapisanie nowego pracownika
     *
     * @Route("/", name="employee_create")
     * @Method("POST")
     * @Template("CompanyBundle:Employee:new.html.twig")
     */
    public function createAction(Request $request)
    {
        # utworzenie nowego obiektu pracownika
        $employee = new Employee();
        $employee->setCompany($this->getUser()->getCompany());
        # przetworzenie formularza
        $form = $this->createCreateForm($employee);
        $form->handleRequest($request);

        # walidacja formularza
        if ($form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            if ($employee->getAddress() instanceof EmployeeAddress) {
                $employee->getAddress()->setEmployee($employee);
                $em->persist($employee->getAddress());
            }

            $em->persist($employee);
            $em->flush();

            # wyświetlenie danych nowego pracownika
            return $this->redirect($this->generateUrl('employee_show', array('id' => $employee->getId())));
        }

        return array(
            'employee' => $employee,
            'form' => $form->createView(),
        );
    }

    /**
     * Metoda zwraca formularz nowego pracownika
     *
     * @param Employee $employee The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Employee $employee)
    {
        # utworzenie formularza
        $form = $this->createForm(new EmployeeType(), $employee, array(
            'action' => $this->generateUrl('employee_create'),
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
     * Wyświetlenie formularza nowego pracownika
     *
     * @Route("/new", name="employee_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        # utworzenie nowego obiektu
        $employee = new Employee();
        #przygotowanie formularza
        $form = $this->createCreateForm($employee);

        return array(
            'employee' => $employee,
            'form' => $form->createView(),
        );
    }

    /**
     * Wyświetlenie informacji konkretnego pracownika
     *
     * @Route("/{id}", name="employee_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie pracownika
        $employee = $em->getRepository('CompanyBundle:Employee')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$employee) {
            throw $this->createNotFoundException('Nie udało się znaleźć pracownika.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Wyświetlenie formularza edycji istniejącego pracownika
     *
     * @Route("/{id}/edit", name="employee_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie pracownika
        $employee = $em->getRepository('CompanyBundle:Employee')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$employee) {
            throw $this->createNotFoundException('Nie udało się znaleźć pracownika.');
        }

        # przygotowanie formularzy
        $editForm = $this->createEditForm($employee);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Metoda zwraca formularz edycji istniejącego pracownika
     *
     * @param Employee $employee The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Employee $employee)
    {
        # utworzenie formularza
        $form = $this->createForm(new EmployeeType(), $employee, array(
            'action' => $this->generateUrl('employee_update', array('id' => $employee->getId())),
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
     * Zapisanie zmian u istniejącego pracownika
     *
     * @Route("/{id}", name="employee_update")
     * @Method("PUT")
     * @Template("CompanyBundle:Employee:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie pracownika
        $employee = $em->getRepository('CompanyBundle:Employee')->find($id);

        if (!$employee) {
            throw $this->createNotFoundException('Nie udało się znaleźć pracownika.');
        }

        # utworzenie formularzy
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($employee);
        $editForm->handleRequest($request);

        # walidacja formularza
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('employee_edit', array('id' => $id)));
        }

        return array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Usunięcie pracownika
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
                throw $this->createNotFoundException('Nie udało się znaleźć pracownika.');
            }

            $em->remove($employee);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('employee'));
    }

    /**
     * Metoda zwraca formularz służacy do usuwania pracownika
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
            ->getForm();
    }
}

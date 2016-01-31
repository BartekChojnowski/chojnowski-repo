<?php

namespace CompanyBundle\Controller;

use AddressBundle\Entity\CompanyAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CompanyBundle\Entity\Company;
use CompanyBundle\Form\CompanyType;

/**
 * Kontroler odpowiedzialny za akcje związane z firmą
 *
 * @Route("/company")
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CompanyController extends Controller
{
    /**
     * Utworzenie nowej firmy
     *
     * @Route("/create", name="company_create")
     * @Method("POST")
     * @Template("CompanyBundle:Company:new.html.twig")
     */
    public function createAction(Request $request)
    {
        # utworzenie nowego obiektu firmy
        $company = new Company();
        # obsługa formularza
        $form = $this->createCreateForm($company);
        $form->handleRequest($request);

        # walidacja formularza
        if ($form->isValid()) {
            $this->getUser()->setCompany($company);

            $em = $this->getDoctrine()->getManager();
            $em->persist($this->getUser());
            $em->persist($company);

            # zapisanie wszystkich adresów firmy
            /** @var CompanyAddress $address */
            foreach ($company->getAddresses() as $address) {
                $address->setCompany($company);
                $em->persist($address);
            }

            $em->flush();

            # wyświetlenie strony ze szczegółami
            return $this->redirect($this->generateUrl('company_show', array('id' => $company->getId())));
        }

        return array(
            'company' => $company,
            'form' => $form->createView(),
        );
    }

    /**
     * Metoda zwraca formularz dodawania nowej firmy
     *
     * @param Company $company Firma
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Company $company)
    {
        # utworzenie formularza
        $form = $this->createForm(new CompanyType(), $company, array(
            'action' => $this->generateUrl('company_create'),
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
     * Wyświetlenie formularza dodawania nowej firmy
     *
     * @Route("/new", name="company_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $company = new Company();
        $company->addAddress(new CompanyAddress());
        $form = $this->createCreateForm($company);

        return array(
            'company' => $company,
            'form' => $form->createView(),
        );
    }

    /**
     * Wyświetlenie szczegółów firmy
     *
     * @Route("/show", name="company_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction()
    {
        $company = $this->getUser()->getCompany();

        if (!$company) {
            throw $this->createNotFoundException('Nie znaleziono firmy.');
        }

        return array(
            'company' => $company,
        );
    }

    /**
     * Wyświetlenie formularza edycji istniejącej firmy
     *
     * @Route("/{id}/edit", name="company_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie firmy
        $company = $em->getRepository('CompanyBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Nie znaleziono firmy.');
        }

        # utworzenie formularza
        $editForm = $this->createEditForm($company);

        return array(
            'entity' => $company,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Metoda zwraca formularz edycji istniejącej firmy
     *
     * @param Company $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Company $entity)
    {
        # utworzenie formularza
        $form = $this->createForm(new CompanyType(), $entity, array(
            'action' => $this->generateUrl('company_update', array('id' => $entity->getId())),
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
     * Edits an existing Company entity.
     *
     * @Route("/{id}", name="company_update")
     * @Method("PUT")
     * @Template("CompanyBundle:Company:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie firmy
        $company = $em->getRepository('CompanyBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Nie znaleziono firmy.');
        }

        # utworzenie i obsługa formularza
        $editForm = $this->createEditForm($company);
        $editForm->handleRequest($request);

        # walidacja formularza
        if ($editForm->isValid()) {
            /** @var CompanyAddress $address */
            foreach ($company->getAddresses() as $address) {
                $address->setCompany($company);
                $em->persist($address);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('company_edit', array('id' => $id)));
        }

        return array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
        );
    }
}

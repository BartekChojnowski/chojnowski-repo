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
 * Company controller.
 *
 * @Route("/company")
 */
class CompanyController extends Controller
{
    /**
     * Creates a new Company entity.
     *
     * @Route("/create", name="company_create")
     * @Method("POST")
     * @Template("CompanyBundle:Company:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $company = new Company();
        $form = $this->createCreateForm($company);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getUser()->setCompany($company);

            $em = $this->getDoctrine()->getManager();
            $em->persist($this->getUser());
            $em->persist($company);

            /** @var CompanyAddress $address */
            foreach ($company->getAddresses() as $address) {
                $address->setCompany($company);
                $em->persist($address);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('company_show', array('id' => $company->getId())));
        }

        return array(
            'company' => $company,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Company entity.
     *
     * @param Company $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Company $entity)
    {
        $form = $this->createForm(new CompanyType(), $entity, array(
            'action' => $this->generateUrl('company_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Zapisz'));

        return $form;
    }

    /**
     * Displays a form to create a new Company entity.
     *
     * @Route("/new", name="company_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $company = new Company();
        $form   = $this->createCreateForm($company);

        return array(
            'entity' => $company,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Company entity.
     *
     * @Route("/show", name="company_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction()
    {
        $company = $this->getUser()->getCompany();

        if (!$company) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        return array(
            'company'      => $company,
        );
    }

    /**
     * Displays a form to edit an existing Company entity.
     *
     * @Route("/{id}/edit", name="company_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('CompanyBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $editForm = $this->createEditForm($company);

        return array(
            'entity'      => $company,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Company entity.
    *
    * @param Company $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Company $entity)
    {
        $form = $this->createForm(new CompanyType(), $entity, array(
            'action' => $this->generateUrl('company_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Zapisz'));

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
        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('CompanyBundle:Company')->find($id);

        if (!$company) {
            throw $this->createNotFoundException('Unable to find Company entity.');
        }

        $editForm = $this->createEditForm($company);
        $editForm->handleRequest($request);

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
            'company'      => $company,
            'edit_form'   => $editForm->createView(),
        );
    }
}

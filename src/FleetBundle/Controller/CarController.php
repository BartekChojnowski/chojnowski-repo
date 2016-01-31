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
 * Kontroler odpowiedzialny za akcje związane z samochodami
 *
 * @Route("/car")
 *
 * @author Bartłomiej Chojnowski <bachojnowski@gmail.com>
 */
class CarController extends Controller
{

    /**
     * Domyślna akcja. Wyświetlenie wszystkich samochodów
     *
     * @Route("/", name="car")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie wszystkich samochodów firmy
        $cars = $em->getRepository('FleetBundle:Car')->findByCompany($this->getUser()->getCompany());

        return array(
            'cars' => $cars
        );
    }
    /**
     * Zapisanie nowego samochodu
     *
     * @Route("/", name="car_create")
     * @Method("POST")
     * @Template("FleetBundle:Car:new.html.twig")
     */
    public function createAction(Request $request)
    {
        # utworzenie nowego obiektu samochodu
        $car = new Car();
        $car->setCompany($this->getUser()->getCompany());

        # przetworzenie formularza
        $form = $this->createCreateForm($car);
        $form->handleRequest($request);

        # walidacja formularza
        if ($form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            # wyświetlenie danych nowego samochodu
            return $this->redirect($this->generateUrl('car_show', array('id' => $car->getId())));
        }

        return array(
            'car' => $car,
            'form'   => $form->createView(),
        );
    }

    /**
     * Metoda zwraca formularz nowego samochodu
     *
     * @param Car $car The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Car $car)
    {
        # utworzenie formularza
        $form = $this->createForm(new CarType(), $car, array(
            'action' => $this->generateUrl('car_create'),
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
     * Wyświetlenie formularza nowego samochodu
     *
     * @Route("/new", name="car_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        # utworzenie nowego obiektu
        $car = new Car();
        #przygotowanie formularza
        $form   = $this->createCreateForm($car);

        return array(
            'car' => $car,
            'form'   => $form->createView(),
        );
    }

    /**
     * Wyświetlenie informacji konkretnego samochodu
     *
     * @Route("/{id}", name="car_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie samochodu
        $car = $em->getRepository('FleetBundle:Car')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$car) {
            throw $this->createNotFoundException('Nie udało się znaleźć samochodu.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'car'      => $car,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Wyświetlenie formularza edycji istniejącego samochodu
     *
     * @Route("/{id}/edit", name="car_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie samochodu
        $car = $em->getRepository('FleetBundle:Car')
            ->findOneBy(array('id' => $id, 'company' => $this->getUser()->getCompany()));

        if (!$car) {
            throw $this->createNotFoundException('Nie udało się znaleźć samochodu.');
        }

        # przygotowanie formularzy
        $editForm = $this->createEditForm($car);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'car'      => $car,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Metoda zwraca formularz edycji istniejącego samochodu
    *
    * @param Car $car The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Car $car)
    {
        # utworzenie formularza
        $form = $this->createForm(new CarType(), $car, array(
            'action' => $this->generateUrl('car_update', array('id' => $car->getId())),
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
     * Zapisanie zmian u istniejącego samochodu
     *
     * @Route("/{id}", name="car_update")
     * @Method("PUT")
     * @Template("FleetBundle:Car:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        # pobranie samochodu
        $car = $em->getRepository('FleetBundle:Car')->find($id);

        if (!$car) {
            throw $this->createNotFoundException('Nie udało się znaleźć samochodu.');
        }

        # utworzenie formularzy
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($car);
        $editForm->handleRequest($request);

        # walidacja formularza
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
     * Usunięcie samochodu
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
                throw $this->createNotFoundException('Nie udało się znaleźć samochodu.');
            }

            $em->remove($car);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('car'));
    }

    /**
     * Metoda zwraca formularz służacy do usuwania samochodu
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

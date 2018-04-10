<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Orden;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Orden controller.
 *
 * @Route("orden")
 */
class OrdenController extends Controller
{
    /**
     * Lists all orden entities.
     *
     * @Route("/", name="orden_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ordens = $em->getRepository('AppBundle:Orden')->findAll();

        return $this->render('orden/index.html.twig', array(
            'ordens' => $ordens,
        ));
    }

    /**
     * Creates a new orden entity.
     *
     * @Route("/new", name="orden_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $orden = new Orden();
        $form = $this->createFormBuilder($orden)
                 ->add('fechaProduccion', DateType::class,array(
                    'label'=>'Fecha de Producción',
                    'widget' => 'single_text',
                    'format' => 'yyyy-mm-dd',
                    'attr'=>array(
                    'class' => 'form-control datepicker',
                )))
                ->add('horaProduccion', TimeType::class, array(
                    'label'=>'Hora de Producción',
                    'widget' => 'single_text',
                    'attr'=>array(
                    'class' => 'form-control datepicker',
                )))
                ->add('lineaProduccion', TextType::class,array('label'=>'Línea de Producción','attr'=>array('class'=>'form-control')))
                ->add('idUserInterpreta', EntityType::class, array(
                    'label' => 'QF Interpretación',
                    'class' => User::class,
                    'query_builder' => function ($er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.roles LIKE :role')
                            ->setParameter('role','%ROLE_REGENTE%')
                            ->orderBy('u.username', 'ASC');
                    },
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data' => 'Seleccionar'
                ))
                ->add('idUserProduccion', EntityType::class, array(
                    'label' => 'QF Producción',
                    'class' => User::class,
                    'query_builder' => function ($er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.roles LIKE :role')
                            ->setParameter('role','%ROLE_PRODUCCION%');
                    },
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data' => 'Seleccionar'
                ))
                ->add('idUserCalidad', EntityType::class, array(
                    'label' => 'QF Calidad',
                    'class' => User::class,
                    'query_builder' => function ($er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.roles LIKE :role')
                            ->setParameter('role','%ROLE_CALIDAD%');
                    },
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data' => 'Seleccionar'
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-5')))            
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orden);
            $em->flush();

            return $this->redirectToRoute('orden_show', array('id' => $orden->getId()));
        }

        return $this->render('orden/new.html.twig', array(
            'orden' => $orden,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a orden entity.
     *
     * @Route("/{id}", name="orden_show")
     * @Method("GET")
     */
    public function showAction(Orden $orden)
    {
        $deleteForm = $this->createDeleteForm($orden);

        return $this->render('orden/show.html.twig', array(
            'orden' => $orden,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing orden entity.
     *
     * @Route("/{id}/edit", name="orden_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Orden $orden)
    {
        $deleteForm = $this->createDeleteForm($orden);
        $editForm = $this->createForm('AppBundle\Form\OrdenType', $orden);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orden_edit', array('id' => $orden->getId()));
        }

        return $this->render('orden/edit.html.twig', array(
            'orden' => $orden,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a orden entity.
     *
     * @Route("/{id}", name="orden_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Orden $orden)
    {
        $form = $this->createDeleteForm($orden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orden);
            $em->flush();
        }

        return $this->redirectToRoute('orden_index');
    }

    /**
     * Creates a form to delete a orden entity.
     *
     * @param Orden $orden The orden entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Orden $orden)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orden_delete', array('id' => $orden->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

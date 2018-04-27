<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Insumo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * Insumo controller.
 *
 * @Route("insumo")
 */
class InsumoController extends Controller
{
    /**
     * Lists all insumo entities.
     *
     * @Route("/", name="insumo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $insumos = $em->getRepository('AppBundle:Insumo')->findAll();

        return $this->render('insumo/index.html.twig', array(
            'insumos' => $insumos,
        ));
    }

    /**
     * Creates a new insumo entity.
     *
     * @Route("/new", name="insumo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $insumo = new Insumo();
        $form = $this->createFormBuilder($insumo)
                ->add('nombreInsumo', TextType::class,array('label'=>'Nombre Vehiculo','attr'=>array('class'=>'form-control')))
                ->add('lote', TextType::class,array('label'=>'Lote','attr'=>array('class'=>'form-control')))
                ->add('fechaVencimiento', DateType::class,array('label'=>'Fecha de Vencimiento','widget' => 'single_text','format' => 'yyyy-mm-dd','attr'=>array(
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                )))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-5')))
                ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insumo);
            $em->flush();

            return $this->redirectToRoute('insumo_show', array('id' => $insumo->getId()));
        }

        return $this->render('insumo/new.html.twig', array(
            'insumo' => $insumo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a insumo entity.
     *
     * @Route("/{id}", name="insumo_show")
     * @Method("GET")
     */
    public function showAction(Insumo $insumo)
    {
        $deleteForm = $this->createDeleteForm($insumo);

        return $this->render('insumo/show.html.twig', array(
            'insumo' => $insumo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing insumo entity.
     *
     * @Route("/{id}/edit", name="insumo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Insumo $insumo)
    {
        $deleteForm = $this->createDeleteForm($insumo);
        $fecha = date_format($insumo->getFechaVencimiento(), 'Y-m-d');
        $editForm = $this->createFormBuilder($insumo)
                ->add('nombreInsumo', TextType::class,array('label'=>'Nombre Vehiculo','attr'=>array('class'=>'form-control','value'=>$insumo->getNombreInsumo())))
                ->add('lote', TextType::class,array('label'=>'Lote','attr'=>array('class'=>'form-control','value'=>$insumo->getLote())))
                ->add('fechaVencimiento', DateType::class,array('label'=>'Fecha de Vencimiento','widget' => 'single_text','format' => 'yyyy-mm-dd','attr'=>array(
                    'class' => 'form-control input-inline datepicker',
                    'value'=>$fecha,
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                )))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-5')))
                ->getForm();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('insumo_index');
        }

        return $this->render('insumo/edit.html.twig', array(
            'insumo' => $insumo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a insumo entity.
     *
     * @Route("/{id}", name="insumo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Insumo $insumo)
    {
        $form = $this->createDeleteForm($insumo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insumo);
            $em->flush();
        }

        return $this->redirectToRoute('insumo_index');
    }

    /**
     * Creates a form to delete a insumo entity.
     *
     * @param Insumo $insumo The insumo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Insumo $insumo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insumo_delete', array('id' => $insumo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

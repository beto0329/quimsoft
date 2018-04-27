<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LineaProduccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Lineaproduccion controller.
 *
 * @Route("lineaproduccion")
 */
class LineaProduccionController extends Controller
{
    /**
     * Lists all lineaProduccion entities.
     *
     * @Route("/", name="lineaproduccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lineaProduccions = $em->getRepository('AppBundle:LineaProduccion')->findAll();

        return $this->render('lineaproduccion/index.html.twig', array(
            'lineaProduccions' => $lineaProduccions,
        ));
    }

    /**
     * Creates a new lineaProduccion entity.
     *
     * @Route("/new", name="lineaproduccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lineaProduccion = new Lineaproduccion();
        $form = $this->createFormBuilder($lineaProduccion)
                ->add('lineaProduccion', TextType::class,array('label'=>'Línea de Producción','attr'=>array('class'=>'form-control')))
                 ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-11')))
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lineaProduccion);
            $em->flush();

            return $this->redirectToRoute('lineaproduccion_index');
        }

        return $this->render('lineaproduccion/new.html.twig', array(
            'lineaProduccion' => $lineaProduccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lineaProduccion entity.
     *
     * @Route("/{id}", name="lineaproduccion_show")
     * @Method("GET")
     */
    public function showAction(LineaProduccion $lineaProduccion)
    {
        $deleteForm = $this->createDeleteForm($lineaProduccion);

        return $this->render('lineaproduccion/show.html.twig', array(
            'lineaProduccion' => $lineaProduccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lineaProduccion entity.
     *
     * @Route("/{id}/edit", name="lineaproduccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LineaProduccion $lineaProduccion)
    {
        $deleteForm = $this->createDeleteForm($lineaProduccion);
        $editForm = $this->createForm('AppBundle\Form\LineaProduccionType', $lineaProduccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lineaproduccion_edit', array('id' => $lineaProduccion->getId()));
        }

        return $this->render('lineaproduccion/edit.html.twig', array(
            'lineaProduccion' => $lineaProduccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lineaProduccion entity.
     *
     * @Route("/{id}", name="lineaproduccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LineaProduccion $lineaProduccion)
    {
        $form = $this->createDeleteForm($lineaProduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lineaProduccion);
            $em->flush();
        }

        return $this->redirectToRoute('lineaproduccion_index');
    }

    /**
     * Creates a form to delete a lineaProduccion entity.
     *
     * @param LineaProduccion $lineaProduccion The lineaProduccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LineaProduccion $lineaProduccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lineaproduccion_delete', array('id' => $lineaProduccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Laboratorio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Laboratorio controller.
 *
 * @Route("laboratorio")
 */
class LaboratorioController extends Controller
{
    /**
     * Lists all laboratorio entities.
     *
     * @Route("/", name="laboratorio_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $laboratorios = $em->getRepository('AppBundle:Laboratorio')->findAll();

        return $this->render('laboratorio/index.html.twig', array(
            'laboratorios' => $laboratorios,
        ));
    }

    /**
     * Creates a new laboratorio entity.
     *
     * @Route("/new", name="laboratorio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $laboratorio = new Laboratorio();
        $form = $this->createFormBuilder($laboratorio)
                ->add('nombre', TextType::class,array('label'=>'Laboratorio','attr'=>array('class'=>'form-control')))
                ->add('contacto', TextType::class,array('label'=>'Contacto','attr'=>array('class'=>'form-control')))
                ->add('telcontacto', TextType::class,array('label'=>'Teléfono Contacto','attr'=>array('class'=>'form-control')))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-4')))
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($laboratorio);
            $em->flush();

            return $this->redirectToRoute('laboratorio_index');
        }

        return $this->render('laboratorio/new.html.twig', array(
            'laboratorio' => $laboratorio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a laboratorio entity.
     *
     * @Route("/{id}", name="laboratorio_show")
     * @Method("GET")
     */
    public function showAction(Laboratorio $laboratorio)
    {
        $deleteForm = $this->createDeleteForm($laboratorio);

        return $this->render('laboratorio/show.html.twig', array(
            'laboratorio' => $laboratorio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing laboratorio entity.
     *
     * @Route("/{id}/edit", name="laboratorio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Laboratorio $laboratorio)
    {
        $deleteForm = $this->createDeleteForm($laboratorio);
        $editForm = $this->createForm('AppBundle\Form\LaboratorioType', $laboratorio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('laboratorio_edit', array('id' => $laboratorio->getId()));
        }

        return $this->render('laboratorio/edit.html.twig', array(
            'laboratorio' => $laboratorio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a laboratorio entity.
     *
     * @Route("/{id}", name="laboratorio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Laboratorio $laboratorio)
    {
        $form = $this->createDeleteForm($laboratorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($laboratorio);
            $em->flush();
        }

        return $this->redirectToRoute('laboratorio_index');
    }

    /**
     * Creates a form to delete a laboratorio entity.
     *
     * @param Laboratorio $laboratorio The laboratorio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Laboratorio $laboratorio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('laboratorio_delete', array('id' => $laboratorio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

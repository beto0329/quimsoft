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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

        $queryOrden = $em->createQuery("SELECT od.id, od.fechaProduccion, od.horaProduccion, od.estado, lp.lineaProduccion FROM AppBundle\Entity\Orden od JOIN od.idLineaProduccion lp ");
        $ordens = $queryOrden->getResult();

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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em =  $this->getDoctrine()->getManager();
        
        $usuario = $em->getRepository('AppBundle:User')->findOneById($user);
        $orden = new Orden();
        $form = $this->createFormBuilder($orden)
                 ->add('fechaProduccion', DateType::class,array(
                    'label'=>'Fecha de Producción',
                    'widget' => 'single_text',
                    'format' => 'yyyy-mm-dd',
                    'attr'=>array(
                        'data-live-search'=>true,
                        'class' => 'form-control datepicker',
                )))
                ->add('horaProduccion', TextType::class, array(
                    'label'=>'Hora de Producción',
                    'attr'=>array(
                        'data-live-search'=>true,
                        'class' => 'form-control timepicker',
                )))
                ->add('idlineaProduccion', EntityType::class, array(
                    'class' => LineaProduccion::class,
                    'choice_label' => 'lineaProduccion',
                    'attr'=>array(
                        'class'=>'form-control selectpicker',                        
                        'data-live-search'=>true,
                        'title'=>'Seleccionar'
                    )))
                ->add('idUserInterpreta', EntityType::class, array(
                    'class' => User::class,                    
                    'data' => $usuario,
                    'choice_label' => 'nombre'))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-5')))            
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orden);
            $em->flush();
            
            $numOrden=$orden->getId();
            $queryOrden = $em->createQuery("SELECT o.id, o.fechaProduccion, o.horaProduccion, o.lineaProduccion, u1.nombre as qfinterpreta "
                    . "FROM AppBundle\Entity\Orden o "
                    . "JOIN o.idUserInterpreta u1 "
                    . "WHERE o.id=:orden ")
                    ->setParameter('orden',$numOrden);
            $ordenMezcla = $queryOrden->getResult();
            $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();
            $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();
            $diagnostico = $this->container->getParameter('diagnostico');
            $eps = $this->container->getParameter('eps');

            return $this->render('default/mezcla.html.twig', array(
                'orden' => $ordenMezcla,
                'diagnostico'  => $diagnostico,
                'eps'  => $eps,
                'medicamentos' => $medicamentos,
                'pacientes'    => $pacientes
                ));
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

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Medicamento;
use AppBundle\Entity\Laboratorio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Medicamento controller.
 *
 * @Route("medicamento")
 */
class MedicamentoController extends Controller
{
    /**
     * Lists all medicamento entities.
     *
     * @Route("/", name="medicamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

//        $medicamentos = $em->getRepository('AppBundle:Medicamento')->findAll();
//        $laboratorio = $em->getRepository('AppBundle:Laboratorio')->find($medicamentos->getIdlaboratorio());
        $queryMedicamento = $em->createQuery("SELECT m.id, m.nombreMedicamento, m.medicamentoLaboratorio, m.presentacionExistencia, m.lote, m.fechaVencimiento, l.nombre FROM AppBundle\Entity\Medicamento m JOIN m.idlaboratorio l ");
        $medicamentos = $queryMedicamento->getResult();
        return $this->render('medicamento/index.html.twig', array(
            'medicamentos' => $medicamentos,
//            'laboratorio' => $laboratorio,
        ));
    }

    /**
     * Creates a new medicamento entity.
     *
     * @Route("/new", name="medicamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medicamento = new Medicamento();
        $form = $this->createFormBuilder($medicamento)
                ->add('nombreMedicamento', TextType::class,array('label'=>'Nombre Medicamento','attr'=>array('class'=>'form-control')))
                ->add('medicamentoLaboratorio', TextType::class,array('label'=>'Medicamento+Laboratorio','attr'=>array('class'=>'form-control')))
                ->add('presentacionExistencia', TextType::class,array('label'=>'Presentación en Existencia','attr'=>array('class'=>'form-control')))
                ->add('lote', TextType::class,array('label'=>'Lote','attr'=>array('class'=>'form-control')))
                ->add('fechaVencimiento', DateType::class,array('label'=>'Fecha de Vencimiento','widget' => 'single_text','format' => 'yyyy-mm-dd','attr'=>array(
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                )))
                ->add('idlaboratorio', EntityType::class, array(
                    'class' => Laboratorio::class,
                    'choice_label' => 'nombre',
                    'attr'=>array(
                        'class'=>'form-control selectpicker',                        
                        'data-live-search'=>true,
                        'title'=>'Seleccionar'
                    ),
                    'data' => 'Seleccionar'
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success col-md-5')))
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicamento);
            $em->flush();

            return $this->redirectToRoute('medicamento_index');
        }

        return $this->render('medicamento/new.html.twig', array(
            'medicamento' => $medicamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medicamento entity.
     *
     * @Route("/{id}", name="medicamento_show")
     * @Method("GET")
     */
    public function showAction(Medicamento $medicamento)
    {
        $deleteForm = $this->createDeleteForm($medicamento);

        return $this->render('medicamento/show.html.twig', array(
            'medicamento' => $medicamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medicamento entity.
     *
     * @Route("/{id}/edit", name="medicamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medicamento $medicamento)
    {
        $deleteForm = $this->createDeleteForm($medicamento);
        $fecha = date_format($medicamento->getFechaVencimiento(), 'Y-m-d');
        $editForm = $this->createFormBuilder($medicamento)
                ->add('nombreMedicamento', TextType::class,array('label'=>'Nombre Medicamento','attr'=>array('class'=>'form-control','value'=>$medicamento->getNombreMedicamento())))
                ->add('medicamentoLaboratorio', TextType::class,array('label'=>'Medicamento+Laboratorio','attr'=>array('class'=>'form-control','value'=>$medicamento->getMedicamentoLaboratorio())))
                ->add('presentacionExistencia', TextType::class,array('label'=>'Presentación en Existencia','attr'=>array('class'=>'form-control','value'=>$medicamento->getPresentacionExistencia())))
                ->add('lote', TextType::class,array('label'=>'Lote','attr'=>array('class'=>'form-control','value'=>$medicamento->getLote())))
                ->add('fechaVencimiento', DateType::class,array('label'=>'Fecha de Vencimiento','widget' => 'single_text','format' => 'yyyy-mm-dd','attr'=>array(
                    'class' => 'form-control input-inline datepicker',
                    'value'=>$fecha,
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'yyyy-mm-dd'
                )))
                ->add('idlaboratorio', EntityType::class, array(
                    'class' => Laboratorio::class,
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data' => $medicamento->getIdlaboratorio()
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'btn btn-success form-control')))
                ->getForm();
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicamento_index');
        }

        return $this->render('medicamento/edit.html.twig', array(
            'medicamento' => $medicamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medicamento entity.
     *
     * @Route("/{id}", name="medicamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Medicamento $medicamento)
    {
        $form = $this->createDeleteForm($medicamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medicamento);
            $em->flush();
        }

        return $this->redirectToRoute('medicamento_index');
    }

    /**
     * Creates a form to delete a medicamento entity.
     *
     * @param Medicamento $medicamento The medicamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medicamento $medicamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicamento_delete', array('id' => $medicamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

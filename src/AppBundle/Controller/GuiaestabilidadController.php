<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Guiaestabilidad;
use AppBundle\Entity\Laboratorio;
use AppBundle\Entity\Medicamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
/**
 * Guiaestabilidad controller.
 *
 * @Route("guiaestabilidad")
 */
class GuiaestabilidadController extends Controller
{
    /**
     * Lists all guiaestabilidad entities.
     *
     * @Route("/", name="guiaestabilidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $queryGuia = $em->createQuery("SELECT g.id, m.medicamentoLaboratorio, g.nombrelasa, g.presentacionfavorita, g.unidadmediad, g.envase, g.condicionesalmacenamiento, g.fotosensible FROM AppBundle\Entity\Guiaestabilidad g JOIN g.idmedicamento m ORDER BY g.id ASC ");
        $guiaestabilidads = $queryGuia->getResult();
        return $this->render('guiaestabilidad/index.html.twig', array(
            'guiaestabilidads' => $guiaestabilidads,
        ));
    }

    /**
     * Creates a new guiaestabilidad entity.
     *
     * @Route("/new", name="guiaestabilidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $guiaestabilidad = new Guiaestabilidad();
        $form = $this->createFormBuilder($guiaestabilidad)
               ->add('idmedicamento', EntityType::class, array(
                    'class' => Medicamento::class,
                    'choice_label' => 'medicamentoLaboratorio',
                    'attr'=>array('class'=>'form-control selectpicker')
                ))
                ->add('nombrelasa', TextType::class,array('label'=>'Nombre Lasa','attr'=>array('class'=>'form-control')))
                ->add('presentacionfavorita', TextType::class,array('label'=>'Presentacion Favorita','attr'=>array('class'=>'form-control')))
                ->add('unidadmediad', TextType::class,array('label'=>'Unidad Mediad','attr'=>array('class'=>'form-control')))
                ->add('volreconstitucion', TextType::class,array('label'=>'Volumen Reconstitucion','attr'=>array('class'=>'form-control')))
                ->add('concentracion', TextType::class,array('label'=>'Concentración','attr'=>array('class'=>'form-control')))
                ->add('envase', TextType::class,array('label'=>'Envase','attr'=>array('class'=>'form-control')))
                ->add('vehiculodilucion', TextType::class,array('label'=>'Vehiculo Dilución','attr'=>array('class'=>'form-control')))
                ->add('volvehiculodilucion', TextType::class,array('label'=>'Volumen Vehiculo Dilución','attr'=>array('class'=>'form-control')))
                ->add('viaadmon', TextType::class,array('label'=>'Vía Administración','attr'=>array('class'=>'form-control')))
                ->add('condicionesalmacenamiento', TextType::class,array('label'=>'Condiciones Almacenamiento','attr'=>array('class'=>'form-control')))
                ->add('fotosensible', ChoiceType::class, array(
                    'choices' =>array(
                        'Si' => 'true',
                        'No'=> 'flase'
                    ),
                    'attr'=>array('class'=>'form-control selectpicker')
                ))
                ->add('estabilidadmezcladias', TextType::class,array('label'=>'Estabilidad Mezcla en Días','attr'=>array('class'=>'form-control')))
                ->add('estabilidadmezclahoras', TextType::class,array('label'=>'Estabilidad Mezcla en Horas','attr'=>array('class'=>'form-control')))
                ->add('estabilidadsobrantedias', TextType::class,array('label'=>'Estabilidad Sobrante en Días','attr'=>array('class'=>'form-control')))
                ->add('estabilidadsobrantehoras', TextType::class,array('label'=>'Estabilidad Sobrante en Horas','attr'=>array('class'=>'form-control')))
                ->add('condialmacensobrante', TextType::class,array('label'=>'Condi. Almacenamiento Sobrante','attr'=>array('class'=>'form-control')))
                ->add('grupoterapeutico', TextType::class,array('label'=>'Grupo Terapéutico','attr'=>array('class'=>'form-control')))
                ->add('ordencampana', TextType::class,array('label'=>'Orden Campaña','attr'=>array('class'=>'form-control')))
                ->add('referencia', TextType::class,array('label'=>'Referencia','attr'=>array('class'=>'form-control')))
                ->add('tiempoinfusion', TextType::class,array('label'=>'Tiempo Infusión','attr'=>array('class'=>'form-control')))
                ->add('tipo', TextType::class,array('label'=>'Tipo','attr'=>array('class'=>'form-control')))
                ->add('idlaboratorio', EntityType::class, array(
                    'class' => Laboratorio::class,
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker')
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'form-control btn btn-success')))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guiaestabilidad);
            $em->flush();

            return $this->redirectToRoute('guiaestabilidad_index');
        }

        return $this->render('guiaestabilidad/new.html.twig', array(
            'guiaestabilidad' => $guiaestabilidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a guiaestabilidad entity.
     *
     * @Route("/{id}", name="guiaestabilidad_show")
     * @Method("GET")
     */
    public function showAction(Guiaestabilidad $guiaestabilidad)
    {
        $deleteForm = $this->createDeleteForm($guiaestabilidad);

        return $this->render('guiaestabilidad/show.html.twig', array(
            'guiaestabilidad' => $guiaestabilidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing guiaestabilidad entity.
     *
     * @Route("/{id}/edit", name="guiaestabilidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Guiaestabilidad $guiaestabilidad)
    {
        $deleteForm = $this->createDeleteForm($guiaestabilidad);
        $fecha = date_format($guiaestabilidad->getFechaVencimiento(), 'Y-m-d');
        $editForm = $this->createFormBuilder($guiaestabilidad)
               ->add('idmedicamento', EntityType::class, array(
                    'class' => Medicamento::class,
                    'choice_label' => 'medicamentoLaboratorio',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data'=>$guiaestabilidad->getIdmedicamento()
                ))
                ->add('nombrelasa', TextType::class,array('label'=>'Nombre Lasa','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getNombrelasa())))
                ->add('presentacionfavorita', TextType::class,array('label'=>'Presentacion Favorita','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getPresentacionfavorita())))
                ->add('unidadmediad', TextType::class,array('label'=>'Unidad Mediad','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getUnidadmediad())))
                ->add('volreconstitucion', TextType::class,array('label'=>'Volumen Reconstitucion','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getVolreconstitucion())))
                ->add('concentracion', TextType::class,array('label'=>'Concentración','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getConcentracion())))
                ->add('envase', TextType::class,array('label'=>'Envase','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getEnvase())))
                ->add('vehiculodilucion', TextType::class,array('label'=>'Vehiculo Dilución','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getVehiculodilucion())))
                ->add('volvehiculodilucion', TextType::class,array('label'=>'Volumen Vehiculo Dilución','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getVolvehiculodilucion())))
                ->add('viaadmon', TextType::class,array('label'=>'Vía Administración','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getViaadmon())))
                ->add('condicionesalmacenamiento', TextType::class,array('label'=>'Condiciones Almacenamiento','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getCondicionesalmacenamiento())))
                ->add('fotosensible', ChoiceType::class, array(
                    'choices' =>array(
                        'Si' => 'true',
                        'No'=> 'flase'
                    ),
                    'choice_value' => $guiaestabilidad->getFotosensible(),
                    'attr'=>array('class'=>'form-control selectpicker')
                ))
                ->add('estabilidadmezcladias', TextType::class,array('label'=>'Estabilidad Mezcla en Días','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getEstabilidadmezcladias())))
                ->add('estabilidadmezclahoras', TextType::class,array('label'=>'Estabilidad Mezcla en Horas','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getEstabilidadmezclahoras())))
                ->add('estabilidadsobrantedias', TextType::class,array('label'=>'Estabilidad Sobrante en Días','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getEstabilidadsobrantedias())))
                ->add('estabilidadsobrantehoras', TextType::class,array('label'=>'Estabilidad Sobrante en Horas','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getEstabilidadsobrantehoras())))
                ->add('condialmacensobrante', TextType::class,array('label'=>'Condi. Almacenamiento Sobrante','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getCondialmacensobrante())))
                ->add('grupoterapeutico', TextType::class,array('label'=>'Grupo Terapéutico','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getGrupoterapeutico())))
                ->add('ordencampana', TextType::class,array('label'=>'Orden Campaña','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getOrdencampana())))
                ->add('referencia', TextType::class,array('label'=>'Referencia','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getReferencia())))
                ->add('tiempoinfusion', TextType::class,array('label'=>'Tiempo Infusión','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getTiempoinfusion())))
                ->add('tipo', TextType::class,array('label'=>'Tipo','attr'=>array('class'=>'form-control','value'=>$guiaestabilidad->getTipo())))
                ->add('idlaboratorio', EntityType::class, array(
                    'class' => Laboratorio::class,
                    'choice_label' => 'nombre',
                    'attr'=>array('class'=>'form-control selectpicker'),
                    'data'=>$guiaestabilidad->getIdlaboratorio()
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar','attr'=>array('class'=>'form-control btn btn-success')))
                ->getForm();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guiaestabilidad_edit', array('id' => $guiaestabilidad->getId()));
        }

        return $this->render('guiaestabilidad/edit.html.twig', array(
            'guiaestabilidad' => $guiaestabilidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a guiaestabilidad entity.
     *
     * @Route("/{id}", name="guiaestabilidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Guiaestabilidad $guiaestabilidad)
    {
        $form = $this->createDeleteForm($guiaestabilidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guiaestabilidad);
            $em->flush();
        }

        return $this->redirectToRoute('guiaestabilidad_index');
    }

    /**
     * Creates a form to delete a guiaestabilidad entity.
     *
     * @param Guiaestabilidad $guiaestabilidad The guiaestabilidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Guiaestabilidad $guiaestabilidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('guiaestabilidad_delete', array('id' => $guiaestabilidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

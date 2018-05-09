<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Medicamento;
use AppBundle\Entity\Laboratorio;
use AppBundle\Entity\Orden;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * Mezclas controller.
 *
 * @Route("mezclas")
 */
class MezclasController extends Controller
{
    
    /**
     * Creates a new mezcla.
     *
     * @Route("/new/{orden}", name="mezcla_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$orden)
    {
        $em = $this->getDoctrine()->getManager();
       $queryOrden = $em->createQuery("SELECT o.id, o.fechaProduccion, o.horaProduccion, u1.nombre as qfinterpreta "
                . "FROM AppBundle\Entity\Orden o "
                . "JOIN o.idUserInterpreta u1 "
                . "WHERE o.id=:orden ")
                ->setParameter('orden',$orden);
        $ordenMezcla = $queryOrden->getResult();
        $queryGuiaEstab = $em->createQuery("SELECT gb.id, md.nombreMedicamento, lb.nombre "
                . "FROM AppBundle\Entity\Guiaestabilidad gb "
                . "JOIN gb.idmedicamento md "
                . "JOIN gb.idlaboratorio lb ");
        $guiaEstabilidad = $queryGuiaEstab->getResult();
        $pacientes = $em->getRepository('AppBundle:Paciente')->findAll();
        $diagnostico = $this->container->getParameter('diagnostico');
        $eps = $this->container->getParameter('eps');

        return $this->render('default/mezcla.html.twig', array(
            'orden' => $ordenMezcla,
            'diagnostico'  => $diagnostico,
            'eps'  => $eps,
            'guiaEstabilidad' => $guiaEstabilidad,
            'pacientes'    => $pacientes
            ));
    }
}

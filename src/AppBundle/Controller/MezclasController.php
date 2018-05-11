<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Medicamento;
use AppBundle\Entity\Laboratorio;
use AppBundle\Entity\Orden;
use AppBundle\Entity\User;
use AppBundle\Entity\Mezcla;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    
    /**
     * Insert a new mezcla.
     *
     * @Route("/insert", name="mezcla_insert")
     * @Method({"POST"})
     */
    public function insertAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        
        for($i=1; $i<=$_POST['contador'];$i++){
            $mezcla = new Mezcla();
            
            $Orden = $em->getRepository('AppBundle:Orden')->findOneById($_POST['idOrden']);
            $Paciente = $em->getRepository('AppBundle:Paciente')->findOneById($_POST["pacienteSelect1"]);
            $Guia = $em->getRepository('AppBundle:Guiaestabilidad')->findOneById($_POST["medicamento$i"]);
            $dosis = $_POST["dosis$i"];        
        
            $mezcla->setIdpaciente($Paciente);
            $mezcla->setIdguiaestabilidad($Guia);
            $mezcla->setIdorden($Orden);
            $mezcla->setDosis($dosis);

            $em->persist($mezcla);
            $em->flush();
        }    
        
        if($mezcla->getId()){
            return New Response(json_encode(array("idMezcla"=>$mezcla->getId())));
        }else{
            return New Response(json_encode(array("idMezcla"=>0)));
        }
        
        
       
    }
}

<?php

namespace App\Controller;
use App\Repository\CircuitRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Circuit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CircuitController extends AbstractController
{
    /**
     * @Route("/circuit", name="circuit")
     */

    /**
     * @var CircuitRepository
     */

    public function __construct(CircuitRepository $cr)
    {
        $this->cr = $cr;
    }

    public function index():Response
    {
        // setCodeCircuit  setDesCircuit setDuree
       /* $cr = new Circuit();
        $cr->setCodeCircuit('Hiver1_local')
            ->setDesCircuit('Tunisie_hiver')
            ->setDuree('10');

        // entity manager
        $em = $this->getDoctrine()->getManager();
        $em -> persist($cr);
        // persister et envoyer à la base de données
        $em -> flush();

*/


        $cr = $this->getDoctrine()->getRepository(Circuit::class)->getCirctuiLessThanDuree(8);

        $em = $this->getDoctrine()->getManager();


        foreach ($cr as $Inc)
        {
        $em->remove($Inc);
        $em->flush();
        }

//        return $this->render('pages/circuit.html.twig',['cr' => $cr]);
        return $this->render('pages/circuit.html.twig');

    }

}

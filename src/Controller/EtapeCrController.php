<?php
namespace App\Controller;
use App\Entity\EtapeCr;
use App\Entity\Ville;
use App\Entity\Circuit;

use Symfony\Component\HttpFoundation\Response;
use App\Repository\EtapeCrRepository;
use App\Repository\VilleRepository;
use App\Repository\CircuitRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtapeCrController extends AbstractController
{
    /**
     * @Route("/etape/cr", name="etape_cr")
     */
    /**
     * @Route("/etapecr", name="etapecr")
     * @param CircuitRepository $etcr
     * @return Response
     */
    public function __construct(EtapeCrRepository $cr)
    {
    $this->cr = $cr;
    }


    public function index():Response
    {


/*
        $circuit = $this->getDoctrine()->getRepository(Circuit::class);
        $circuit = $circuit->find('1');

        // ete local admet l'id 1

        $ville = $this->getDoctrine()->getRepository(Ville::class);
        $ville= $ville->find('1');
        // charger la ville avec l'id 1 qui est dans notre cas tunis

        $etcr = new EtapeCr();

        $etcr->setVille($ville)
            ->setCircuit($circuit)
            ->setDuree('2')
            ->setOrdre('1');
        // id 1 siginifie Tunisie
        $em = $this->getDoctrine()->getManager();
        $em -> persist($etcr);
        // persister et envoyer à la base de données
        $em -> flush();

         in case I wanted to delete an entity

       $entityManager->remove($product);
       $entityManager->flush();






*/

        // the answer for 2
        /*$etapecr = $this->getDoctrine()->getRepository(EtapeCr::class);
        $query = $etapecr->createQuery(
            'SELECT Max(p)
            FROM App\Entity\EtapeCr p
            WHERE p.ville.code_ville = hurghada')->;

        $etcrs=$query->getResult();


        
        //$etcrs = $this->getDoctrine()->getRepository(EtapeCr::class)->findBy(['ordre' => '1']);
*/

/*
        $circuit = $this->getDoctrine()->getRepository(EtapeCr::class)->findAll();
        $destination = $this->getDoctrine()->getRepository(Circuit::class)->findAll();

*/

        $etcrs = $this->getDoctrine()->getRepository(EtapeCr::class)->getDureeEtapeCircuitVille('1');

        $em = $this->getDoctrine()->getManager();


        foreach ($etcrs as $Inc)
        {


            $Inc->setDuree('3');

            $em->merge($Inc);
            $em->flush();
        }

        return $this->render('pages/etapecr.html.twig',['etcrs' => $etcrs]);

    }
}

<?php

namespace App\Controller;
use App\Entity\Destination;
use App\Entity\Ville;

use App\Repository\DestinationRepository;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/ville", name="ville")
     * @param VilleRepository $ville
     * @return Response


     */



    /**
     * @Route("/ville", name="ville.index")
     * @param VilleRepository $ville
     * @return Response

     */

    public function __construct(VilleRepository $ville)
    {
        $this->ville = $ville;
    }



    public function index():Response
    {
       // to load the entity mode of the destination class
        $dest = $this->getDoctrine()->getRepository(Destination::class);
            // charge the country withing the id given in arrows
        $dest = $dest->find('3');
        // id 1 siginifie Tunisie
        $ville = new Ville();
        $ville->setCodeVille('212_1')
            ->setDesVille('CasaBlanca')
            ->setDestTest($dest);

        // entity manager
        $em = $this->getDoctrine()->getManager();
        $em -> persist($ville);
        // persister et envoyer à la base de données
        $em -> flush();
        return $this->render('pages/ville.html.twig',['ville' => $ville]);



    }
}

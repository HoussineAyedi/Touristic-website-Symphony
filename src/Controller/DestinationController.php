<?php

namespace App\Controller;
use App\Entity\Destination;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;


class DestinationController  extends AbstractController
{


/**
* @Route("/Dest", name="destination.index")
* @param DestinationRepository $dest
* @return Response

*/
	
/**
* @var DestinationRepository
*/



/*
public function __construct(Environment $twig)
	{
		$this->twig = $twig;
	}
*/	
	public function __construct(DestinationRepository $dest)
		{
			$this->dest = $dest;
		}

    public function index(DestinationRepository $dest):Response
    {
        /*
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
    FROM AppBundle:Destination d AppBundle:Circuit c
    WHERE p.price > :price
    ORDER BY p.price ASC'
        )->setParameter('price', 19.99);

        $products = $query->getResult();
        */
		$dests = $dest->findAll();
		if ($dest){
		return $this->render('pages/home.html.twig',['dests' => $dests]);
		}
		else {$this->render('pages/home.html.twig'); }



// In case I wanted to insert anything in here

/*
    	$destination = new Destination();
    	$destination->setCodeDest('90')
    			->setDestTest('Egypte');

    		// entity manager
    	$em = $this->getDoctrine()->getManager();
    	$em -> persist($destination);
    	// persister et envoyer à la base de données
    	$em -> flush();

*/	
    // to access the repository
    	/*

    	$dest = $this->dest->findAllVisible();
    	dump ($dest);
    
        */


        
    }

}




/*
	


*/
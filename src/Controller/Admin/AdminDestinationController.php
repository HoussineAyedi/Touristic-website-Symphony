<?php

namespace App\Controller\Admin;
use App\Entity\Destination;
//use Doctrine\Common\Persistence\ObjectManager: '@doctrine.orm.default_entity_manager'
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DestinationType;

use Symfony\Component\HttpFoundation\Request;

class AdminDestinationController extends AbstractController
{
    /**
    * @var DestinationRepository
    */

    private $repository;

    /**
    * @var EntityManagerInterface
    */
    private $em;

	public function __construct(DestinationRepository $repository, EntityManagerInterface $em)
		{
			$this->repository = $repository;
			$this->em = $em;
		}

       /**
       *@Route("/admin" , name="admin.destination.index")
       *@return \Symfony\Component\HttpFoundation\Response
       */

    public function index()
    {
        $dests = $this->repository->findAll();
        return $this->render('admin/destination/index.html.twig', compact('dests'));
    }

    // pour cree une nouvelle destination

    /**
    *@Route("/admin/destination/create",name="admin.destination.new")
    */

    public function new(Request $request)
    {

        $destination = new Destination();
        // getting info from form
        $form=$this->createForm(DestinationType::class, $destination );
        // handle and manage the query
        $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid())
                        {
                            $this->em->persist($destination);
                            $this->em->flush();
                            $this->addFlash('success', 'Destination Ajoutée avec succes');

                            return $this->redirectToRoute('admin.destination.index');
                        }
     return $this->render('admin/destination/new.html.twig', [
            'destination'=>$destination ,
            'form'=>$form->createView()
            ]);



    }











           /**
           *@Route("/admin/destination/{id}" , name="admin.destination.edit")
           *@param Destination $destination
           *@param Request $request
           *@return \Symfony\Component\HttpFoundation\Response
           */
    public function edit(Destination $destination, Request $request)
    {
        // to access the form method recently created
        // cette entité et utilisé pour le remplissage du formulaire

        $form=$this->createForm(DestinationType::class, $destination );
        // to handle the request
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $this->em->flush();
                    $this->addFlash('success', 'Destination modifiée avec succes');
                    return $this->redirectToRoute('admin.destination.index');
                }

        return $this->render('admin/destination/edit.html.twig', [
        'destination'=>$destination ,
        'form'=>$form->createView()
        ]);

    }
/**
*@param Destination $destination
*@Route ("/admin/destination/delete/{id}", name="admin.destination.delete")
*return \Symfony\Component\HttpFoundation\RedirectResponse
*/

    public function delete(Destination $destination)
    {
        $this->em->remove($destination);
        $this->em->flush();
        $this->addFlash('success', 'Supression effectuée avec succes');


        return $this->redirectToRoute('admin.destination.index');
    }



}




/*
	


*/
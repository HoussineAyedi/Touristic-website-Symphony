<?php

namespace App\Controller\Admin;
use App\Entity\Circuit;
//use Doctrine\Common\Persistence\ObjectManager: '@doctrine.orm.default_entity_manager'
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CircuitType;

use Symfony\Component\HttpFoundation\Request;

class AdminCircuitController extends AbstractController
{
    /**
    * @var CircuitRepository
    */

    private $repository;

    /**
    * @var EntityManagerInterface
    */
    private $em;

	public function __construct(CircuitRepository $repository, EntityManagerInterface $em)
		{
			$this->repository = $repository;
			$this->em = $em;
		}

       /**
       *@Route("/admin/circuit" , name="admin.circuit.index")
       *@return \Symfony\Component\HttpFoundation\Response
       */

    public function index()
    {
        //$dests = $this->repository->findAll();

        $dests = $this->repository->findAll();

        return $this->render('admin/circuit/index.html.twig', compact('dests'));
    }

    // pour cree une nouvelle Circuit

    /**
    *@Route("/admin/circuit/create",name="admin.circuit.new")
    */

    public function new(Request $request)
    {

        $circuit = new Circuit();
        // getting info from form
        $form=$this->createForm(CircuitType::class, $circuit );
        // handle and manage the query
        $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid())
                        {
                            $this->em->persist($circuit);
                            $this->em->flush();
                            $this->addFlash('success', 'Circuit Ajoutée avec succes');

                            return $this->redirectToRoute('admin.circuit.index');
                        }
     return $this->render('admin/circuit/new.html.twig', [
            'circuit'=>$circuit ,
            'form'=>$form->createView()
            ]);



    }











           /**
           *@Route("/admin/Circuit/{id}" , name="admin.circuit.edit")
           *@param Circuit $circuit
           *@param Request $request
           *@return \Symfony\Component\HttpFoundation\Response
           */
    public function edit(Circuit $circuit, Request $request)
    {
        // to access the form method recently created
        // cette entité et utilisé pour le remplissage du formulaire

        $form=$this->createForm(CircuitType::class, $circuit );
        // to handle the request
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $this->em->flush();
                    $this->addFlash('success', 'Circuit modifiée avec succes');
                    return $this->redirectToRoute('admin.circuit.index');
                }

        return $this->render('admin/circuit/edit.html.twig', [
        'circuit'=>$circuit ,
        'form'=>$form->createView()
        ]);

    }
/**
*@param Circuit $Circuit
*@Route ("/admin/Circuit/delete/{id}", name="admin.circuit.delete")
*return \Symfony\Component\HttpFoundation\RedirectResponse
*/

    public function delete(Circuit $circuit)
    {
        $this->em->remove($circuit);
        $this->em->flush();
        $this->addFlash('success', 'Supression effectuée avec succes');


        return $this->redirectToRoute('admin.circuit.index');
    }



}




/*
	


*/
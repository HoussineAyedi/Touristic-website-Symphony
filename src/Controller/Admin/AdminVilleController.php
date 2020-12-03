<?php

namespace App\Controller\Admin;
use App\Entity\Ville;
//use Doctrine\Common\Persistence\ObjectManager: '@doctrine.orm.default_entity_manager'
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VilleType;

use Symfony\Component\HttpFoundation\Request;

class AdminVilleController extends AbstractController
{
    /**
    * @var VilleRepository
    */

    private $repository;

    /**
    * @var EntityManagerInterface
    */
    private $em;

	public function __construct(VilleRepository $repository, EntityManagerInterface $em)
		{
			$this->repository = $repository;
			$this->em = $em;
		}

       /**
       *@Route("/admin/ville" , name="admin.ville.index")
       *@return \Symfony\Component\HttpFoundation\Response
       */

    public function index()
    {
        //$dests = $this->repository->findAll();

        $dests = $this->repository->findBy(['dest_test'=>'id']);

        return $this->render('admin/ville/index.html.twig', compact('dests'));
    }

    // pour cree une nouvelle Ville

    /**
    *@Route("/admin/ville/create",name="admin.ville.new")
    */

    public function new(Request $request)
    {

        $ville = new Ville();
        // getting info from form
        $form=$this->createForm(VilleType::class, $ville );
        // handle and manage the query
        $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid())
                        {
                            $this->em->persist($ville);
                            $this->em->flush();
                            $this->addFlash('success', 'Ville Ajoutée avec succes');

                            return $this->redirectToRoute('admin.ville.index');
                        }
     return $this->render('admin/ville/new.html.twig', [
            'ville'=>$ville ,
            'form'=>$form->createView()
            ]);



    }











           /**
           *@Route("/admin/Ville/{id}" , name="admin.ville.edit")
           *@param Ville $ville
           *@param Request $request
           *@return \Symfony\Component\HttpFoundation\Response
           */
    public function edit(Ville $ville, Request $request)
    {
        // to access the form method recently created
        // cette entité et utilisé pour le remplissage du formulaire

        $form=$this->createForm(VilleType::class, $ville );
        // to handle the request
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $this->em->flush();
                    $this->addFlash('success', 'Ville modifiée avec succes');
                    return $this->redirectToRoute('admin.ville.index');
                }

        return $this->render('admin/ville/edit.html.twig', [
        'ville'=>$ville ,
        'form'=>$form->createView()
        ]);

    }
/**
*@param Ville $Ville
*@Route ("/admin/Ville/delete/{id}", name="admin.ville.delete")
*return \Symfony\Component\HttpFoundation\RedirectResponse
*/

    public function delete(Ville $ville)
    {
        $this->em->remove($ville);
        $this->em->flush();
        $this->addFlash('success', 'Supression effectuée avec succes');


        return $this->redirectToRoute('admin.ville.index');
    }



}




/*
	


*/
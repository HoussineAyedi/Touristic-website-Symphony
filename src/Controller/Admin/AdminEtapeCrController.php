<?php

namespace App\Controller\Admin;
use App\Entity\EtapeCr;
//use Doctrine\Common\Persistence\ObjectManager: '@doctrine.orm.default_entity_manager'
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EtapeCrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EtapeCrType;

use Symfony\Component\HttpFoundation\Request;

class AdminEtapeCrController extends AbstractController
{
    /**
    * @var EtapeCrRepository
    */

    private $repository;

    /**
    * @var EntityManagerInterface
    */
    private $em;

	public function __construct(EtapeCrRepository $repository, EntityManagerInterface $em)
		{
			$this->repository = $repository;
			$this->em = $em;
		}

       /**
       *@Route("/admin/etapecr" , name="admin.etapecr.index")
       *@return \Symfony\Component\HttpFoundation\Response
       */

    public function index()
    {
        //$dests = $this->repository->findAll();

        $dests = $this->repository->findAll();

        return $this->render('admin/etapecr/index.html.twig', compact('dests'));
    }

    // pour cree une nouvelle EtapeCr

    /**
    *@Route("/admin/etapecr/create",name="admin.etapecr.new")
    */

    public function new(Request $request)
    {

        $etapecr = new EtapeCr();
        // getting info from form
        $form=$this->createForm(EtapeCrType::class, $etapecr );
        // handle and manage the query
        $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid())
                        {
                            $this->em->persist($etapecr);
                            $this->em->flush();
                            $this->addFlash('success', 'EtapeCr Ajoutée avec succes');

                            return $this->redirectToRoute('admin.etapecr.index');
                        }
     return $this->render('admin/etapecr/new.html.twig', [
            'etapecr'=>$etapecr ,
            'form'=>$form->createView()
            ]);



    }











           /**
           *@Route("/admin/etapecr/{id}" , name="admin.etapecr.edit")
           *@param EtapeCr $etapecr
           *@param Request $request
           *@return \Symfony\Component\HttpFoundation\Response
           */
    public function edit(EtapeCr $etapecr, Request $request)
    {
        // to access the form method recently created
        // cette entité et utilisé pour le remplissage du formulaire

        $form=$this->createForm(EtapeCrType::class, $etapecr );
        // to handle the request
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
                {
                    $this->em->flush();
                    $this->addFlash('success', 'EtapeCr modifiée avec succes');
                    return $this->redirectToRoute('admin.etapecr.index');
                }

        return $this->render('admin/etapecr/edit.html.twig', [
        'etapecr'=>$etapecr ,
        'form'=>$form->createView()
        ]);

    }
/**
*@param EtapeCr $EtapeCr
*@Route ("/admin/etapecr/delete/{id}", name="admin.etapecr.delete")
*return \Symfony\Component\HttpFoundation\RedirectResponse
*/

    public function delete(EtapeCr $etapecr)
    {
        $this->em->remove($etapecr);
        $this->em->flush();
        $this->addFlash('success', 'Supression effectuée avec succes');


        return $this->redirectToRoute('admin.etapecr.index');
    }



}




/*
	


*/
<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    #[Route('/admin/aliments', name: 'admin_aliments')]
    public function index(AlimentRepository $repository): Response
    {

      $aliments = $repository->findAll();
        return $this->render('admin/admin_aliment/index.html.twig', [
            'aliments' => $aliments,
        ]);
    }
    #[Route('/admin/aliments/create', name:'admin_aliments_create')]
    #[Route('/admin/aliments/{id}', name:"admin_aliments_edit", methods:['GET','POST'])]
      public function createAndEditAction(Aliment $aliment = null, Request $request, EntityManagerInterface $manager) 
      {
        if(!$aliment){
          $aliment = new Aliment();
        }
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $modif = $aliment->getId()!== null;
          $manager->persist($aliment);
          $this->addFlash("success", ($modif) ? "La modification a été effectuée" : "L'ajout a été effectuée");
          $manager->flush();

          return $this->redirectToRoute('admin_aliments');
        }

        return $this->render('admin/admin_aliment/edit_aliment.html.twig', [
          'aliment' => $aliment,
          'form' => $form->createView(),
          'modification' => $aliment->getId() !== null
        ]);
      }
      #[Route("/admin/aliments/{id}", name:"admin_aliments_suppression", methods:['delete'])]
        public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $manager) {
          if($this->isCsrfTokenValid('SUP' . $aliment->getId(), $request->get('_token'))) {
              $manager->remove($aliment);
              $manager->flush();
              $this->addFlash("success", "La suppression a été effectuée");

              return $this->redirectToRoute('admin_aliments');
          }
      }

}

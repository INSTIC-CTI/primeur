<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSecuController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
      $utilisateur = new Utilisateur();
      $form = $this->createForm(InscriptionType::class, $utilisateur);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      $manager->persist($utilisateur);
      $manager->flush();
    }
        return $this->render('admin_secu/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

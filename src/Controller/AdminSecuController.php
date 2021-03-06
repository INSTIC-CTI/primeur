<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminSecuController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $encoder): Response
    {
      $utilisateur = new Utilisateur();
      $form = $this->createForm(InscriptionType::class, $utilisateur);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
      $passwordCrypte = $encoder->hashPassword($utilisateur, $utilisateur->getPassword());
      $utilisateur->setPassword($passwordCrypte);
      $manager->persist($utilisateur);
      $manager->flush();
    }
        return $this->render('admin_secu/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'connexion')]
    public function login(AuthenticationUtils $authUtil)
    {
      return $this->render('admin_secu/login.html.twig', [
        'lastUserName' => $authUtil->getLastUsername(),
        'error' => $authUtil->getLastAuthenticationError(),
      ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {

    }
}

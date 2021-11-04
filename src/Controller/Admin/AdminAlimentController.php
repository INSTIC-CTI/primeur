<?php

namespace App\Controller\Admin;

use App\Repository\AlimentRepository;
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
}
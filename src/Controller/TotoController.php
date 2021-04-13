<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TotoController extends AbstractController
{
    /**
     * @Route("/toto", name="toto")
     */
    public function index(): Response
    {
        return $this->render('toto/index.html.twig', [
            'controller_name' => 'TotoController',
        ]);
    }
    
    /**
     * @Route("/toto/tutu", name="tutu")
     */
    public function test(): Response
    {
        return $this->render('toto/tutu.html.twig', [
            'controller_name' => 'TotoController',
        ]);
    }
}

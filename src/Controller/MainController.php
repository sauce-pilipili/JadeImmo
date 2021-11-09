<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/achat", name="achat")
     */
    public function achat(): Response
    {
        return $this->render('main/achat.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/vendre", name="vendre")
     */
    public function vendre(): Response
    {
        return $this->render('main/vendre.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/agence", name="agence")
     */
    public function agence(): Response
    {
        return $this->render('main/agence.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/legal", name="legal")
     */
    public function legal(): Response
    {
        return $this->render('main/legal.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/actualite", name="legal")
     */
    public function actualite(): Response
    {
        return $this->render('main/actualite.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/show", name="legal")
     */
    public function actuShow(): Response
    {
        return $this->render('main/actuShow.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/presentation", name="legal")
     */
    public function presentationBien(): Response
    {
        return $this->render('main/presentationBien.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}

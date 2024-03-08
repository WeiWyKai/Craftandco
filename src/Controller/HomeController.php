<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_homepage');
        }
        
        return $this->render('home/index.html.twig');
    }

    #[Route('/homepage', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('home/homepage.html.twig');
    }

     #[Route('/recipes', name: 'app_recipes')]
    public function recipes(): Response
    {
        return $this->render('home/recipes.html.twig');
    }

    


}

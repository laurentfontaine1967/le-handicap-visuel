<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     *@Route("/", name="index")
     */
    public function Index()
    {

        return $this->render('/public/home.html.twig');
    }
}
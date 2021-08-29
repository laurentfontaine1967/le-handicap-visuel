<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LadministratifController extends AbstractController
{

    /**
     *@Route("/ladministratif", name="ladministratif")
     */
    public function ShowAdministratif()
    {

        return $this->render('/public/ladministratif.html.twig');
    }
}
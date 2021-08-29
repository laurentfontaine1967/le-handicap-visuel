<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommercantController extends AbstractController
{

    /**
     *@Route("/commercant", name="commercant")
     */
    public function ShowCommercant()
    {

        return $this->render('/public/commercant.html.twig');
    }
}
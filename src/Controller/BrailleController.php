<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BrailleController extends AbstractController
{

    /**
     *@Route("/braille", name="braille")
     */
    public function ShowBraille()
    {

        return $this->render('/public/braille.html.twig');
    }
}
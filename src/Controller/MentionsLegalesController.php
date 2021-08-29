<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentionsLegalesController extends AbstractController
{

    /**
     *@Route("/mentions_legales", name="mentions_legales")
     */
    public function ShowMentionsLegales()
    {

        return $this->render('/public/mentions_legales.html.twig');
    }
}
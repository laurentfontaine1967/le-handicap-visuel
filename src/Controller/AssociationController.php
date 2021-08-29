<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AssociationController extends AbstractController
{

    /**
     *@Route("/association", name="association")
     */
    public function ShowAssociation()
    {

        return $this->render('/public/association.html.twig');
    }
}
<?php

namespace App\Controller;



use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{

    /**
     *@Route("/news", name="news")
     */
    public function ShowNews()
    {

        return $this->render('/public/news.html.twig');
    }
}
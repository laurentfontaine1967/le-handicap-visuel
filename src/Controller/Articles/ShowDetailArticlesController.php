<?php

namespace App\Controller\Articles;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowDetailArticlesController extends AbstractController
{
    /**
     * @Route("/articles/show_articles_detail/{id}", name="show_articles_detail")
     * 
     */
    public function showDetails(int $id, ArticleRepository $articleRepository): Response
    {


        $article = $articleRepository->findOneBy([
            'user' => $id

        ]);

        if (!$article) {

            return $this->redirectToRoute('auteur_home');
        }


        return $this->render("article/show_articles_details.html.twig", [
            'article' => $article,
        ]);
    }
}
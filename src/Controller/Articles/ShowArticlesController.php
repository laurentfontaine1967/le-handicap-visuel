<?php

namespace App\Controller\Articles;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowArticlesController extends AbstractController
{
    /**
     * @Route("/articles/show_articles", name="show_articles")
     * 
     */
    public function show(Request $request, PaginatorInterface $paginatorInterface, ArticleRepository $articleRepository): Response
    {

        $data = $articleRepository->findAll();
        $articles = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );


        return $this->render("article/show_articles.html.twig", [
            'articles' => $articles
        ]);
    }
}
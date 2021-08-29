<?php

namespace App\Controller\Articles\Auteur;

use App\Form\ContactOtherType;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowMyArticlesController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur_home")
     * 
     */
    public function show(Request $request, PaginatorInterface $paginatorInterface, ArticleRepository $articleRepository): Response
    {
        $user = $this->getUser();


        $data = $articleRepository->findBy([
            'user' => $user
        ]);

        $articles = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );






        return $this->render("auteur/home.html.twig", [
            'articles' => $articles
        ]);
    }
}
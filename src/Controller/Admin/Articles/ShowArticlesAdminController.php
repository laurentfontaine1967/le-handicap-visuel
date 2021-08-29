<?php

namespace App\Controller\Admin\Articles;



use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowArticlesAdminController extends AbstractController
{

    /**
     *@Route("/admin/articles", name="admin_show_article")
     *@IsGranted("ROLE_ADMIN")
     */
    public function adminShowArticles(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginatorInterface): Response
    {

        $data = $articleRepository->findAll();


        $articles = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render("/admin/articles/admin_articles_show.html.twig", [
            'articles' => $articles
        ]);
    }
}
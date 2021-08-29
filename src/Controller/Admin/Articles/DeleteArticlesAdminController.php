<?php

namespace App\Controller\Admin\Articles;


use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteArticlesAdminController extends AbstractController
{

    /**
     *@Route("/admin/articles/{id}", name="admin_delete_article")
     *@IsGranted("ROLE_ADMIN")
     */
    public function adminDeleteArticles(int $id, EntityManagerInterface $em, ArticleRepository $articleRepository): RedirectResponse
    {

        $article = $articleRepository->find($id);
        $em->remove($article);
        $em->flush();
        $this->addFlash('success', 'ce post a bien ete supprimé');
        return $this->redirectToRoute('admin_show_article');
    }
}
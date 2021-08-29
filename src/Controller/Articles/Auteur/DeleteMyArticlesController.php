<?php

namespace App\Controller\Articles\Auteur;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteMyArticlesController extends AbstractController
{
    /**
     * @Route("auteur/delete/{id}", name="auteur_delete")
     */
    public function delete(int $id, Request $request, EntityManagerInterface $em, ArticleRepository $articleRepository): RedirectResponse
    {
        $article = $articleRepository->find($id);

        if (!$article) {

            return $this->redirectToRoute('auteur_home');
        }



        $user = $this->getUser();

        $em->remove($article);
        $em->flush();

        $this->addFlash('success', 'Votre article a bien été supprimé.');

        return $this->redirectToRoute('auteur_home');
    }
}
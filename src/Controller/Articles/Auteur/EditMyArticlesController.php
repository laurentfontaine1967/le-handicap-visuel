<?php

namespace App\Controller\Articles\Auteur;

use App\Form\ArticleType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditMyArticlesController extends AbstractController
{
    /**
     * @Route("auteur/edit/{id}", name="auteur_edit")
     */
    public function edit(int $id, Request $request, EntityManagerInterface $em, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);
        if (!$article) {

            return $this->redirectToRoute('auteur_home');
        }

        $user = $this->getUser();


        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $em->flush();

            $this->addFlash('success', 'Votre article a bien été modifié.');

            return $this->redirectToRoute('auteur_home');
        }

        return $this->render('auteur/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
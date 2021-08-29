<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminHomeController extends AbstractController
{

    /**
     *@Route("/admin", name="admin_home")
     *@IsGranted("ROLE_ADMIN")
     */
    public function show(UserRepository $userRepository, ArticleRepository $articleRepository): Response
    {

        // $user = $this->getUser();

        $users = $userRepository->findBy(
            [],
            ['id' => 'DESC'],
            5
        );



        $articles = $articleRepository->findBy(
            [],
            ['id' => 'DESC'],
            5
        );



        return $this->render('/admin/admin_home.html.twig', [
            'users' => $users,
            'articles' => $articles
        ]);
    }
}
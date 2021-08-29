<?php

namespace App\Controller\Admin\Users;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowUserAdminController extends AbstractController
{

    /**
     *@Route("/admin/users", name="admin_show_user")
     *@IsGranted("ROLE_ADMIN")
     */
    public function adminShowUser(Request $request, PaginatorInterface $paginatorInterface, UserRepository $userRepository): Response
    {

        $data = $userRepository->findAll();

        $users = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );



        return $this->render("/admin/user/admin_user_show.html.twig", [
            'users' => $users
        ]);
    }
}
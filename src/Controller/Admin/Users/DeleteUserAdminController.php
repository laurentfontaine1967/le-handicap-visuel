<?php

namespace App\Controller\Admin\Users;

use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteUserAdminController extends AbstractController
{

    /**
     *@Route("/admin/users/{id}", name="admin_delete_user")
     *@IsGranted("ROLE_ADMIN")
     */
    public function adminDeleteUser(int $id, UserRepository $userRepository, EntityManagerInterface $em,ArticleRepository $articleRepository): RedirectResponse
    {

        $user = $this->getUser();

        $userIdentity = $userRepository->find($id);


        if (!$userIdentity)
        {

          return $this->redirectToRoute('admin');
        } 
        else if ($userIdentity===$user)
        {
            
             $this->addFlash('danger','L\'Administrateur ne peut pas se supprimer!!!!');
            return $this->redirectToRoute('admin_show_user');
        }
        //suppression des post
           //chercher les post

           $data = $articleRepository->findBy(
            [],
            ['id' => 'DESC'] );
            $nombre=count($data)-1;

          // dd($nombre);
          if ( $nombre > 0) {
           //avertir
           $this->addFlash('danger','Tous les Post de cet utilisateur vont également etres supprimés.');

           //supprimer les posts

           for ($i = 0; $i<=$nombre; $i++) {
            $em->remove($data[($i)]);
            $em->flush($data[($i)]);

           }
          
          }

        $em->remove($userIdentity);
        $em->flush();
        $this->addFlash('success', 'cet utilisateur a bien ete supprimé');
        return $this->redirectToRoute('admin_show_user');
   
}
}
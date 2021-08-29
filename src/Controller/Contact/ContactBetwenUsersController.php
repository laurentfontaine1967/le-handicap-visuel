<?php

namespace App\Controller\Contact;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\ContactBetweenUsersType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactBetwenUsersController extends AbstractController
{
    /**
     * @Route("/user/contact_between_users/{id}", name="contact_between_users")
     */
    public function register(int $id, Request $request, UserRepository $userRepository, MailerInterface $mailer): Response
    {
        $user = $this->getUser();

        $userIdentity = $userRepository->find($id);
        if (!$userIdentity) {

            return $this->redirectToRoute('auteur_home');
        } else if ($userIdentity===$user){
            
        $this->addFlash('danger','Vous ne pouvez pas vous écrire à vous-meme !!!!');
            return $this->redirectToRoute('show_articles');
        }
        

        // $user = $this->getUser();

        $form = $this->createForm(ContactBetweenUsersType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->get('message')->getData();



            $email = (new TemplatedEmail())
                ->from($user->getEmail())
                ->to($userIdentity->getEmail())
                ->subject('Ce pseudo vous contacte')
                ->htmlTemplate('email/contactOthers.html.twig')
                ->context([
                    'message' => $message,
                    'userIdentity' => $userIdentity
                ]);


            $mailer->send($email);
            $this->addFlash('success', 'Votre email a bien été envoyé.');
            return $this->redirectToRoute('auteur_home');
        }


        return $this->render('contact/contact_between_users.html.twig', [
            'form' => $form->createView(),
            'userIdentity' => $userIdentity,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('pseudo', TextType::class, [
                'label' => 'Entrer un nom d\'utilisateur',
                'attr' => [
                    'placeholder' => 'Entrer le nom d\'utilisateur'
                ],
                'constraints' => [

                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom d\'utilisateur doit contenir au minimum 2 caractères'
                    ]),
                ],
            ])



            ->add('email', EmailType::class, [
                'label' => 'Entrer votre email',
                'attr' => [
                    'placeholder' => 'Tapez l\'email ici...'
                ],
            ])


            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['placeholder' => 'Veuillez entrer votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veiullez saisir un mot de passe valide',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins{{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
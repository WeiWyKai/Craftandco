<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'required' => false,
                'label' => "Nom: ",
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom'
                    ]),  
                ]
            ])
            ->add('firstname', TextType::class, [
                'required' => false,
                'label' => "Prénom: ",
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom'
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => "Email: ",
                'attr' => [
                    'class' => 'form-control mb-2'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse est requise"
                    ]),
                    new Email([
                        'message' => "L'adresse est invalide"
                    ])
                ]
            ])
            ->add('phoneNumber', TextType::class,[
                'label' => "Numéro de téléphone: ",
                'attr' => [
                    'class' => 'form-control mb-2 '
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => "Le numéro est requis"
                    ]),
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary my-2'
                ],
            ]);   
        }
        
        // ->add('plainPassword', PasswordType::class, [
        //     // instead of being set onto the object directly,
        //     // this is read and encoded in the controller
        //     'mapped' => false,
        //     'attr' => ['autocomplete' => 'new-password'],
        //     'constraints' => [
        //         new NotBlank([
        //             'message' => 'Please enter a password',
        //         ]),
        //         new Length([
        //             'min' => 6,
        //             'minMessage' => 'Your password should be at least {{ limit }} characters',
        //             // max length allowed by Symfony for security reasons
        //             'max' => 4096,
        //         ]),
        //     ],
        // ])

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

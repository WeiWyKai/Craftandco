<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RecipeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Votre nouvelle recette:',
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez renseigner le nom de votre recette',

                    ]),
                    New Length([
                        'min' => 3,
                        'minMessage' => 'Le nom doit contenir au minimum {{ limit }} caractères'
                    ])
                ],
            ])
            ->add('recipe_preview', FileType::class,[
                'label' => 'Choisissez une image:',
                'help' => 'formats acceptés: jpeg, jpg, pdf, png',
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'maxSizeMessage' => 'Le fichier ne doit pas dépasser 2Ko',
                        'extensions'=> ['png','jpeg', 'jpg', 'pdf'],
                        'extensionsMessage' => 'Veuillez choisir une image au bon format',
                    ])
                ]
            ])
            ->add('category', ChoiceType::class,[
                'label' => 'Catégorie:',
                'choices' =>[ 
                    'Sucré' => 'sugar',
                    'Salé' => 'salt'
                ]

            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn button my-2'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}

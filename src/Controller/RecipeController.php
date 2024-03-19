<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeFormType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/allRecipes', name: 'app_all_recipes')]
    public function allRecipes(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
    
    #[Route('/addRecipe', name: 'app_add_recipe')]
    public function addRecipe(EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = new Recipe();
        $recipeForm = $this->createForm(RecipeFormType::class, $recipe);
        $recipeForm -> handleRequest($request);

        if ($recipeForm->isSubmitted() && $recipeForm->isValid()) {
            $recipe->setRecipeLink("asset('img/loupe.png')");

            $entityManager->persist($recipe);
            $entityManager->flush();
        

        }
        return $this->render('recipe/add.html.twig', [
            'recipeForm' => $recipeForm
        ]);
    }
}

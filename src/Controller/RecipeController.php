<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeFormType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/allRecipes/{cat}', name: 'app_all_recipes')]
    public function allRecipes(RecipeRepository $recipeRepository): Response
    {   
        $url= $_SERVER['REQUEST_URI'];
        $category=basename(parse_url($url, PHP_URL_PATH));
        
        switch($category){
            case 'sugar':
                $recipes = $recipeRepository->findBy(['category'=> 'sugar']);
                break; 
            case 'salt':
                $recipes = $recipeRepository->findBy(['category'=> 'salt']);
                break;
            default:
                $recipes = $recipeRepository->findAll();
        }
        
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'cat' => $category
        ]);
    }
    
    #[Route('/addRecipe', name: 'app_add_recipe')]
    public function addRecipe(EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = new Recipe();
        $recipeForm = $this->createForm(RecipeFormType::class, $recipe);
        $recipeForm -> handleRequest($request);

        if ($recipeForm->isSubmitted() && $recipeForm->isValid()) {

            $file = $recipeForm->get('recipe_preview')->getData();
            $recipeName = str_replace(' ','', strtolower($recipeForm->get('name')->getData()));
            $newRecipeName = "$recipeName.{$file->guessExtension()}";
            $recipe->setRecipeLink('img/loupe.png');
            $recipe->setRecipePreview("$newRecipeName");
            $cat = $recipeForm->get('category')->getData();
            $file->move('recipes', $newRecipeName);
            
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash('success', 'Votre recette a bien été ajoutée!');

            return $this->redirectToRoute('app_all_recipes',[
                'cat' => $cat 
            ]);
        }
        return $this->render('recipe/add.html.twig', [
            'recipeForm' => $recipeForm
        ]);
    }
}

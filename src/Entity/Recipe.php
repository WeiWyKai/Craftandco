<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $recipe_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recipe_preview = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipeLink(): ?string
    {
        return $this->recipe_link;
    }

    public function setRecipeLink(string $recipe_link): static
    {
        $this->recipe_link = $recipe_link;

        return $this;
    }

    public function getRecipePreview(): ?string
    {
        return $this->recipe_preview;
    }

    public function setRecipePreview(?string $recipe_preview): static
    {
        $this->recipe_preview = $recipe_preview;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }
}

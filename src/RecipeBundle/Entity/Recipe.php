<?php

namespace RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Recipe
 *
 * Entity class for describe Recipe Object
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="RecipeBundle\Repository\RecipeRepository")
 * @UniqueEntity("name")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Ingredient", inversedBy="recipes", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="recipe_x_ingredient",
     *  joinColumns={
     *      @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     *  }
     * )
     */
    private $ingredients;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifyDate", type="datetime")
     */
    private $modifyDate;

    /**
     * @var int
     *
     * @ORM\Column(name="ingredientsNumber", type="smallint")
     */
    private $ingredientsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="detailInstruction", type="text")
     */
    private $detailInstruction;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Recipe
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set modifyDate
     *
     * @param \DateTime $modifyDate
     *
     * @return Recipe
     */
    public function setModifyDate($modifyDate)
    {
        $this->modifyDate = $modifyDate;

        return $this;
    }

    /**
     * Get modifyDate
     *
     * @return \DateTime
     */
    public function getModifyDate()
    {
        return $this->modifyDate;
    }

    /**
     * Set ingredientsNumber
     *
     * @param integer $ingredientsNumber
     *
     * @return Recipe
     */
    public function setIngredientsNumber($ingredientsNumber)
    {
        $this->ingredientsNumber = $ingredientsNumber;

        return $this;
    }

    /**
     * Get ingredientsNumber
     *
     * @return int
     */
    public function getIngredientsNumber()
    {
        return $this->ingredientsNumber;
    }

    /**
     * Set detailInstruction
     *
     * @param string $detailInstruction
     *
     * @return Recipe
     */
    public function setDetailInstruction($detailInstruction)
    {
        $this->detailInstruction = $detailInstruction;

        return $this;
    }

    /**
     * Get detailInstruction
     *
     * @return string
     */
    public function getDetailInstruction()
    {
        return $this->detailInstruction;
    }

    /**
     * Add ingredient
     *
     * @param \RecipeBundle\Entity\Ingredient $ingredient
     *
     * @return Recipe
     */
    public function addIngredient(\RecipeBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;

        $this->setIngredientsNumber( count($this->ingredients) );

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \RecipeBundle\Entity\Ingredient $ingredient
     */
    public function removeIngredient(\RecipeBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * Get ingredients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Method getNumberIngredients
     *
     * Return number of ingredients related to this Recipe
     *
     * @return int
     */
    public function getNumberIngredients(){
        return count($this->ingredients);
    }
}

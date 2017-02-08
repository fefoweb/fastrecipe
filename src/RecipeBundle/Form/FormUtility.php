<?php

namespace RecipeBundle\Form;
use RecipeBundle\Entity\Ingredient;
use RecipeBundle\Entity\Recipe;

/**
 * Class FormUtility
 * @package RecipeBundle\Form
 *
 * Form Utility for some simple modification about interchange data from form and the model
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */

class FormUtility{
    
    public function __construct()
    {
        // TODO: Implement __construct() method.
    }

    /**
     * method convertDataFromForm
     *
     * Conversion from the data of the form to the rapresentation in entity
     *
     * @access public
     * @param Recipe $recipe
     * @param boolean $isNew
     * @return Recipe
     */
    public function convertDataFromForm(Recipe $recipe, $isNew = true){
        /** @var Recipe $newRecipe */
        $newRecipe = clone $recipe;
        
        /** post process the data from the submit */
        $iIngredientNumber = $newRecipe->getIngredientsNumber();
        $sCreationDate = $newRecipe->getCreationDate();
        $sModifyDate = $newRecipe->getModifyDate();
        $aIngredients = $newRecipe->getIngredients();
    
        //eventually ingredients
        /** @var Ingredient $ingredient */
        foreach($aIngredients as $ingredient){
            $sIngCreationDate = $ingredient->getCreationDate();
            $sIngModifyDate = $ingredient->getModifyDate();

            if(!empty($sIngCreationDate) && is_string($sIngCreationDate) && $isNew){
                $dIngCreationDate = new \DateTime($sIngCreationDate);
                $ingredient->setCreationDate($dIngCreationDate);
            }
            if(!empty($sIngModifyDate) && is_string($sIngModifyDate)){
                $dIngModifyDate = new \DateTime($sIngModifyDate);
                $ingredient->setModifyDate($dIngModifyDate);
            }
        }
        
        //recipe
        if(empty($iIngredientNumber)){
            $numIngredients = $newRecipe->getActualNumberIngredients();
            $newRecipe->setIngredientsNumber($numIngredients);
        }
        if(!empty($sCreationDate) && is_string($sCreationDate) && $isNew){
            $dCreationDate = new \DateTime($sCreationDate);
            $newRecipe->setCreationDate($dCreationDate);
        }
        if(!empty($sModifyDate) && is_string($sModifyDate)){
            $dModifyDate = new \DateTime($sModifyDate);
            $newRecipe->setModifyDate($dModifyDate);
        }
        
        return $newRecipe;
    }

}
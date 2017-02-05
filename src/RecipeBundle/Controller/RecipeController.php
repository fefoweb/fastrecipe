<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecipeBundle\Entity\Recipe;

class RecipeController extends Controller
{
    /**
     * @Route("/recipe/new")
     */
    public function newAction()
    {

        $ingredient = new Ingredient();
        $ingredient->setName('Orecchiette');
        $ingredient->setCreationDate(new \DateTime());
        $ingredient->setModifyDate(new \DateTime());
        $ingredient->setDescription("Loren ipsum");
        $ingredient->setType('Pasta');

        $ingredient2 = new Ingredient();
        $ingredient2->setName('Broccoletti');
        $ingredient2->setCreationDate(new \DateTime());
        $ingredient2->setModifyDate(new \DateTime());
        $ingredient2->setDescription("Loren ipsum");
        $ingredient2->setType('Verdura');

        $recipe = new Recipe();
        $recipe->setName("Orecchiette al pesto");
        $recipe->setCreationDate(new \DateTime());
        $recipe->setModifyDate(new \DateTime());
        $recipe->setDetailInstruction("sdfsdfasdfas");
        $recipe->addIngredient($ingredient);
        $recipe->addIngredient($ingredient2);

        $em = $this->getDoctrine()->getManager();
        $em->persist($ingredient);
        $em->persist($ingredient2);
        $em->persist($recipe);
        $em->flush();


        return $this->render('RecipeBundle:Recipe:new.html.twig', [
            'inserted' => sprintf(  'Saved ingredient: %s[%d] | Saved recipe: %s[%d]',
                                   $ingredient->getName().''.$ingredient2->getName(), $ingredient->getId()."-".$ingredient2->getId(),
                                   $recipe->getName(), $recipe->getId()
                                 )
        ]);
    }

    /**
     * @Route("/recipe/edit")
     */
    public function editAction()
    {
        return $this->render('RecipeBundle:Recipe:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/recipe/remove")
     */
    public function removeAction()
    {
        return $this->render('RecipeBundle:Recipe:remove.html.twig', array(
            // ...
        ));
    }

}

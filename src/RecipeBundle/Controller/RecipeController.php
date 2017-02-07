<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Entity\Ingredient;
use RecipeBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecipeBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;

class RecipeController extends Controller
{
    /**
     * @Route("/recipe/new")
     */
    public function newAction(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var Recipe $data */
            $data = $form->getData();
            if(empty($data->getIngredientsNumber())){
                $numIngredients = $data->getNumberIngredients();
                $data->setIngredientsNumber($numIngredients);
            }
            dump($data);
            //saving

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        return $this->render('RecipeBundle:Recipe:new.html.twig', [
            'form' => $form->createView()
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

<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Entity\Ingredient;
use RecipeBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecipeBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use RecipeBundle\Form\FormUtility;

class RecipeController extends Controller
{
    /**
     * @Route("/recipe/new")
     */
    public function newAction(Request $request)
    {
        /** @var Recipe $recipe */
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){
            $formUtility = new FormUtility();
            
            /** @var Recipe $data */
            $data = $form->getData();
            $recipeToSave = $formUtility->convertDataFromForm($data);

            $em = $this->getDoctrine()->getManager();
            $em->persist($recipeToSave);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('RecipeBundle:recipe:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/recipe/edit/{recipeId}", name="edit_recipe", requirements={"recipeId": "\d+"})
     */
    public function editAction(Request $request, $recipeId)
    {
        /** @var Recipe $recipe */
        $recipe = $this->getDoctrine()
                       ->getRepository('RecipeBundle:Recipe')
                       ->find($recipeId);

        if (!$recipe) {
            throw $this->createNotFoundException('No recipe found with id: '.$recipe );
        }

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $formUtility = new FormUtility();
            /** @var Recipe $data */
            $data = $form->getData();
            $data = $formUtility->convertDataFromForm($data, false);


            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('RecipeBundle:recipe:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/recipe/remove/{recipeId}", name="remove_recipe", requirements={"recipeId": "\d+"})
     */
    public function removeAction()
    {
        return $this->render('RecipeBundle:recipe:remove.html.twig', array(
            // ...
        ));
    }

}

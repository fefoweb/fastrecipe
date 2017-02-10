<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Entity\Ingredient;
use RecipeBundle\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecipeBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class RecipeController extends Controller
{
    /**
     * Method newAction
     *
     * Add a recipe
     * @param Request $request
     * @Route("/recipe/new", name="new_recipe")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        /** @var Recipe $recipe */
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe, array(
            'formtype' => 'new'
        ));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var Recipe $data */
            $data = $form->getData();
            $nIngredients = $data->getActualNumberIngredients();
            $data->setIngredientsNumber($nIngredients);

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('RecipeBundle:recipe:new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Method editAction
     *
     * Edit a recipe
     * @param Request $request
     * @param $recipeId
     * @Route("/recipe/edit/{recipeId}", name="edit_recipe", requirements={"recipeId": "\d+"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
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
        $form = $this->createForm(RecipeType::class, $recipe, array(
            'formtype' => 'edit',
            'idrecipe' => $recipe->getId()
        ));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var Recipe $data */
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('RecipeBundle:recipe:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Method removeAction
     *
     * Edit a recipe
     * @param Request $request
     * @param $recipeId
     * @Route("/recipe/remove/{recipeId}", name="remove_recipe", requirements={"recipeId": "\d+"})
     *
     * @return JsonResponse
     */
    public function removeAction(Request $request, $recipeId)
    {
        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('data' => 'this is a json response'));
        }
    }

    /**
     * @Route("/recipe/list", name="list_recipe")
     */
    /**
     * Method listRecipeAction
     *
     * List all recipes
     * @Route("/recipe/list", name="list_recipe")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listRecipeAction()
    {
        /** @var array $recipes */
        $recipes = $this->getDoctrine()
            ->getRepository('RecipeBundle:Recipe')
            ->findAll();

        return $this->render('RecipeBundle:default:index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}

<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Form\Type\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RecipeBundle\Entity\Recipe;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

            return $this->redirectToRoute("list_recipe", array('messages' => 'The recipe '.$recipe->getName().' has been added!'));
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
        $em = $this->getDoctrine()->getManager();
        /** @var Recipe $recipe */
        $recipe = $em->getRepository('RecipeBundle:Recipe')
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
            $data->setModifyDate(new \DateTime('now'));
            $data->setModifyDateIngredients();
            $em->flush();

            return $this->redirectToRoute("list_recipe", array('messages' => 'The recipe '.$recipe->getName().' has been updated!'));
        }

        return $this->render('RecipeBundle:recipe:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Method removeAction
     *
     * Remove a recipe
     * @param Request $request
     * @param $recipeId
     * @Route("/recipe/remove/{recipeId}", name="remove_recipe", requirements={"recipeId": "\d+"})
     *
     * @return JsonResponse
     */
    public function removeAction(Request $request, $recipeId)
    {
        $em = $this->getDoctrine()->getManager();
        
        /** @var Recipe $recipe */
        $recipe = $em->getRepository('RecipeBundle:Recipe')
                     ->find($recipeId);

        if (!$recipe) {
            throw $this->createNotFoundException('No recipe found with id: '.$recipeId );
        }

        $em->remove($recipe);
        $em->flush();

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('removed' => true, 'idremoved' => $recipeId, 'name' => $recipe->getName()));
        } else {
            return $this->redirectToRoute("list_recipe", array('messages' => 'The recipe '.$recipe->getName().' has been deleted!'));
        }
    }
    /**
     * Method listRecipeAction
     *
     * List all recipes
     * @Route("/recipe/list/{query}", name="list_recipe", requirements={"query": ".*"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listRecipeAction(Request $request, $query = null)
    {
        if(empty(trim($query))){
            /** @var array $recipes */
            $recipes = $this->getDoctrine()
                ->getRepository('RecipeBundle:Recipe')
                ->findAll();

            $title = "All recipes...";
        } else {
            $aQuery = preg_split( "/(\\s|-|#)/", $query );
            $queryBuilder = $this->getDoctrine()->getRepository('RecipeBundle:Recipe')->createQueryBuilder('r');

            $or = $queryBuilder->expr()->orx();
            foreach($aQuery as $key => $criteria){
                $or->add($queryBuilder->expr()->like("(r.name", ":recipename)" ));
                $queryBuilder->setParameter('recipename', "%{$criteria}%");
            }
            $queryBuilder->where($or);
            $recipes = $queryBuilder->getQuery()->getResult();

            $title = "You searched for [".implode(',', $aQuery)."]";
        }
        $messages = $request->query->get('messages');

        return $this->render('RecipeBundle:default:listing.html.twig', [
            'recipes' => $recipes,
            'messages' => $messages,
            'title_listing' => $title
        ]);
    }
}

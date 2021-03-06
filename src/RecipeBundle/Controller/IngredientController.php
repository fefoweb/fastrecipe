<?php

namespace RecipeBundle\Controller;

use RecipeBundle\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IngredientController extends Controller
{
    /**
     * @Route("/remove")
     */
    /**
     * Method removeAction
     *
     * Remove an ingredient
     * @param Request $request
     * @param $ingredientId
     * @Route("/ingredient/remove/{ingredientId}", name="remove_ingredient", requirements={"ingredientId": "\d+"})
     *
     * @return JsonResponse
     */
    public function removeAction(Request $request, $ingredientId)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var Ingredient $ingredient */
        $ingredient = $em->getRepository('RecipeBundle:Ingredient')
                         ->find($ingredientId);

        if (!$ingredient) {
            throw $this->createNotFoundException('No ingredient found with id: '.$ingredientId );
        }

        $em->remove($ingredient);
        $em->flush();

        if ($request->isXMLHttpRequest()) {
            return new JsonResponse(array('removed' => true, 'idremoved' => $ingredientId, 'name' => $ingredient->getName()));
        } else {
            return $this->redirectToRoute("list_recipe", array('messages' => 'The ingredient '.$ingredient->getName().' has been deleted!'));
        }

    }
    /**
     * Method findAction
     *
     * Remove an ingredient
     * @param Request $request
     * @Route("/ingredient/find", name="ingredient_find")
     *
     * @return JsonResponse
     */
    public function findAction(Request $request) {
        $names = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RecipeBundle:Ingredient')->createQueryBuilder('ing')
                        ->where('ing.name LIKE :name')
                        ->setParameter('name', '%'.$term.'%')
                        ->getQuery()
                        ->getResult();

        /** @var Ingredient $entity */
        foreach ($entities as $entity)
        {
            $names[] = $entity->getName();
        }

        $names = array_unique($names);

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

}

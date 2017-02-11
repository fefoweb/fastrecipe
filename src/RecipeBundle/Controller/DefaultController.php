<?php

namespace RecipeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        /** @var array $recipes */
        $recipes = $this->getDoctrine()
                    ->getRepository('RecipeBundle:Recipe')
                    ->findBy(array(), array('modifyDate' => 'DESC'), 2, null);

        return $this->render('RecipeBundle:default:index.html.twig', [
            'recipes' => $recipes
        ]);
    }

}

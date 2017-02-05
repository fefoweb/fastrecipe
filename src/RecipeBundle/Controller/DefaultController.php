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
        return $this->render('RecipeBundle:default:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function listAction()
    {
        /**
         * @var array $aRecipe
         */
        $aRecipe = array(
            array('name' => 'nome1', 'desc' => 'descrizione1', 'ing' => 'ingredienti'),
            array('name' => 'nome2', 'desc' => 'descrizione2', 'ing' => 'ingredienti'),
            array('name' => 'nome3', 'desc' => 'descrizione3', 'ing' => 'ingredienti')
        );

        return $this->render('RecipeBundle:default:listing.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'recipes' => $aRecipe
        ]);
    }
}

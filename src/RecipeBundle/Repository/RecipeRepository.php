<?php

namespace RecipeBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class RecipeRepository
 * @package RecipeBundle\Repository
 * Recipe Repository Container Class
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class RecipeRepository extends EntityRepository
{
    /**
     * Method findAll
     *
     * Redefine findAll of EntityRepository for manage the order on which the recipe are listed.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->findBy(array(), array('modifyDate' => 'DESC'));
    }
}

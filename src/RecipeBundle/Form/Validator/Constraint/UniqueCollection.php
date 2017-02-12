<?php

namespace RecipeBundle\Form\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueCollection Constraint
 * @package RecipeBundle\Form\Validator\Constraint
 * Constraint unique collection
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 *
 * @Annotation
 */
class UniqueCollection extends Constraint
{
    public $message = 'The %value% is already present!';
    // The property path used to check wether objects are equal
    // If none is specified, it will check that objects are equal
    public $propertyPath = null;

    public function validatedBy() {
        return 'unique_collection';
    }
}

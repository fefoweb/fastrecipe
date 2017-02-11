<?php

namespace RecipeBundle\Form\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class UniqueCollection Validator
 * @package RecipeBundle\Form\Validator
 * Constraint unique collection validator
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class UniqueCollectionValidator extends ConstraintValidator
{
    /**
     * Method validate
     *
     * @param mixed $collection
     * @param Constraint $constraint
     *
     */
    public function validate($collection, Constraint $constraint) {

        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $previousValues = array();
        foreach ($collection as $collectionItem) {
            $value = $propertyAccessor->getValue($collectionItem, $constraint->propertyPath);
            $previousSimilarValuesNumber = count(array_keys($previousValues, $value));
            if ($previousSimilarValuesNumber == 1) {
                $this->context->addViolation($constraint->message, array('%value%' => $value));
            }
            $previousValues[] = $value;
        }
    }
}
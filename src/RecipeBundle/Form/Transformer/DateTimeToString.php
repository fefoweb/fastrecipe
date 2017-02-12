<?php

namespace RecipeBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class DateTimeToStringTransformer
 * @package RecipeBundle\Form\Transformer
 * Transformer from dateTime to String and vice-versa
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class DateTimeToString implements DataTransformerInterface
{

    public function __construct() {}

    /**
     * @param \DateTime|null $dateTime
     * @return string
     */
    public function transform($dateTime)
    {
        if (null === $dateTime) {
            return '';
        }
        return $dateTime->format('Y-m-d H:i:s');
    }

    /**
     * @param  string $dateTimeString
     * @return \DateTime
     */
    public function reverseTransform($dateTimeString)
    {
        $dateTime = new \DateTime($dateTimeString);
        return $dateTime;
    }
}

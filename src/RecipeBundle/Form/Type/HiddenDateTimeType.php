<?php

namespace RecipeBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use RecipeBundle\Form\Transformer\DateTimeToString;

/**
 * Class HiddenDateTimeType
 * @package Symfony\Component\Form\Type
 * Type for hidden date time
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class HiddenDateTimeType extends AbstractType
{

    public function __construct() {}

    public function getName() {
        return 'hidden_datetime';
    }

    public function getParent() {
        return HiddenType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $transformer = new DateTimeToString();
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolver $resolver) {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array());
    }

}

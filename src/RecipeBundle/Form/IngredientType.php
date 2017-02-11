<?php
namespace RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use RecipeBundle\Form\Type\HiddenDateTimeType;

/**
 * Class IngredientType
 * @package RecipeBundle\Form
 *
 * Ingredient form type
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class IngredientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'ingredient_name')
            ))
            ->add('creationDate', HiddenDateTimeType::class, array())
            ->add('modifyDate', HiddenDateTimeType::class, array())
            ->add('description', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                                   'data_class' => 'RecipeBundle\Entity\Ingredient'
                               ));
    }

    public function getName() {
        return 'form_ingredient_type';
    }
}
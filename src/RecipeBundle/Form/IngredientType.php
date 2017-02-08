<?php
namespace RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

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
    /*
     * ->add('creationDate', DateTimeType::class, array(
                'data' => new \DateTime(),
            ))
            ->add('modifyDate', DateTimeType::class, array(
                'data' => new \DateTime(),
            ))
     */

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class)
            ->add('creationDate', HiddenType::class, array(
                'data' => date('Y-m-d H:i:s'),
            ))
            ->add('modifyDate', HiddenType::class, array(
                'data' => date('Y-m-d H:i:s'),
            ))
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
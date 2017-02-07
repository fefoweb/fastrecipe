<?php
namespace RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use RecipeBundle\Form\IngredientType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


/**
 * Class RecipeType
 * @package RecipeBundle\Form
 *
 * Recipe form type
 * Project: fastRecipe
 * Since: 2017
 * Author: fefoweb - stefanofra@gmail.com
 */
class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class)
            ->add('detailInstruction', TextareaType::class)
            ->add('creationDate', DateTimeType::class, array(
                'data' => new \DateTime(),
            ))
            ->add('modifyDate', DateTimeType::class, array(
                'data' => new \DateTime(),
            ))
            ->add('ingredients', CollectionType::class, array(
                                   'entry_type' => IngredientType::class,
                                   'entry_options' => array(
                                       'attr' => array('class' => 'ingredient-box')
                                   ),
                                   'label' => false,
                                   'allow_add' => true)
            )
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                                   'data_class' => 'RecipeBundle\Entity\Recipe'
                               ));
    }

    public function getName() {
        return 'form_recipe_type';
    }
}
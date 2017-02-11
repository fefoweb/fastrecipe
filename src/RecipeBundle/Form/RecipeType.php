<?php
namespace RecipeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use RecipeBundle\Form\Type\HiddenDateTimeType;

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
            ->add('creationDate', HiddenDateTimeType::class, array())
            ->add('modifyDate', HiddenDateTimeType::class, array())
            ->add('ingredients', CollectionType::class, array(
                                   'entry_type' => IngredientType::class,
                                   'entry_options' => array(
                                       'attr' => array('class' => 'ingredient-box')
                                   ),
                                   'label' => false,
                                   'allow_add' => true,
                                   'error_bubbling' => false
                               )
            )
            ->add('save', SubmitType::class);

        if(isset($options['formtype']) && ('edit' == $options['formtype'])){
            $builder->add('remove', ButtonType::class, array('attr' => [
                'class' => 'btn btn-danger',
                'data-action' => 'remove',
                'data-id' => $options['idrecipe'],
                'data-type' => 'recipe',
                'data-where' => 'edit'
            ]));
        }
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
                                   'data_class' => 'RecipeBundle\Entity\Recipe',
                                   'formtype' => null,
                                   'idrecipe' => null
                               ));
    }

    public function getName() {
        return 'form_recipe_type';
    }
}
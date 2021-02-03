<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('author')
            ->add('category', EntityType::class, [
                'class'=> Category::class,
                'choice_label'=>'name'
            ])
            ->add('isPublished')
//            ->add('dateCreated', DateTimeType::class, [
//                "label"=>"Date de création",
//                "date_widget"=>"single_text"
//            ])
                //Ce champs n'eest pas associé à une propriété de ntre classe !
            ->add('picture', FileType::class, [
                'mapped'=>false,
                'constraints'=>[
                    //contrainte  de validation spécifique pour l'image
                    new Image([
                        'maxSize'=> '8000k',
                        'maxSizeMessage'=>'Too big !'
                    ])
                ]
            ])
            ->add('submit',SubmitType::class, array('label' => 'Create Wish'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\ArticlePurpose;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Compatibility;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('content')
            ->add('weight')
            ->add('height')
            ->add('width')
            ->add('length')
            ->add('stock')
            ->add('price')
            ->add('imageMain')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('compatibility', EntityType::class, [
                'class' => Compatibility::class,
                'choice_label' => 'name'
            ])
            ->add('articleType', EntityType::class, [
                'class' => \App\Entity\ArticleType::class,
                'choice_label' => 'name'
            ])
            ->add('articlePurpose', EntityType::class, [
                'class' => ArticlePurpose::class,
                'choice_label' => 'name'
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'csrf_protection' => false
        ]);
    }
}

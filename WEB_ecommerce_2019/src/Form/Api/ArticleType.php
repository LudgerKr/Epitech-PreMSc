<?php

namespace App\Form\Api;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = $options['data'];
        $builder
            ->add('title', null, ['data' => $data['article']['title']])
            ->add('category', ChoiceType::class, [
                'choices' => array_column($data['categories'], 'id', 'name'),
                'data' => $data['article']['category']['id']
            ])
            ->add('content', TextareaType::class, ['data' => $data['article']['content']])
            ->add('height', null, ['data' => $data['article']['height']])
            ->add('weight', null, ['data' => $data['article']['weight']])
            ->add('width', null, ['data' => $data['article']['width']])
            ->add('length', null, ['data' => $data['article']['length']])
            ->add('stock', null, ['data' => $data['article']['stock']])
            ->add('price', null, ['data' => $data['article']['price']])
            ->add('imageMain', null, ['data' => $data['article']['imageMain']])
            ->add('image1', null, ['data' => $data['article']['image1']])
            ->add('image2', null, ['data' => $data['article']['image2']])
            ->add('image3', null, ['data' => $data['article']['image3']])
            ->add('compatibility', ChoiceType::class, [
                'choices' => array_column($data['compatibilities'], 'id', 'name'),
                'data'=> $data['article']['compatibility']['id']
            ])
            ->add('articleType', ChoiceType::class, [
                'choices' => array_column($data['articleTypes'], 'id', 'name'),
                'data'=> $data['article']['articleType']['id']
            ])
            ->add('articlePurpose', ChoiceType::class, [
                'choices' => array_column($data['articlePurposes'], 'id', 'name'),
                'data'=> $data['article']['articlePurpose']['id']
            ])
            ->add('brand', ChoiceType::class, [
                'choices' => array_column($data['brands'], 'id', 'name'),
                'data'=> $data['article']['brand']['id']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Colour;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Titre'])
            ->add('description', null, ['label' => 'Description'])
            ->add('price', null, ['label' => 'Prix'])
            ->add('picture',    FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'required' => false,
            ])
            ->add('category', EntityType::class,[
                "class" => Category::class,
                "choice_label" => "name",
                "label" => 'Catégorie'
            ])
            ->add('colour', EntityType::class,[
                "class" => Colour::class,
                "choice_label" => "name",
                "label" => 'Couleur',
            ])
            ->add('brand', EntityType::class,[
                "class" => Brand::class,
                "choice_label" => "name",
                "label" => "Marque",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

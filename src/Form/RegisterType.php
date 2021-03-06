<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null, ['label' => 'Pseudo  '])
            ->add('lastname',null, ['label' => 'Nom  '])
            ->add('firstname',null, ['label' => 'Prénom  '])
            ->add('email', EmailType::class, ['label' => 'Email  '])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'required' => true,
                'first_options' => ['label' => 'Mot de passe  '],
                'second_options' =>['label' => 'Confirmer mot de passe  ']
            ])
            ->add('phone', null,['label'=> 'Téléphone  '])

            ->add('photo', FileType::class, [
                'label' => 'Photo  ',
                'mapped' => false,
                'required' => false,
            ])
            ->add('zip', null,['label'=> 'Code Postal   '])
            ->add('city', HiddenType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'allow_extra_fields' => true,
        ]);
    }
}

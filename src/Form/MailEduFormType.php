<?php

namespace App\Form;

use App\Entity\MailEdus;
use App\Entity\Educateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Security;




class MailEduFormType extends AbstractType
{
    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            //->add('datenvoi', options:[
            //    'label' => 'Date'
            //])
            ->add('objet')
            ->add('message')
            ->add('educateurid', EntityType::class, [
                'class' => Educateur::class,
                'label' => 'Educateur',
                'placeholder' => 'Choisir',
                'choice_label' => function (Educateur $edu){
                    if( $edu->getEmail() != $this->security->getUser()->getEmail() ){
                        return $edu->getEmail();
                    }
                    
                },
                'choice_value' => 'id',
            ])
           /*  ->add('educateurid', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options'  => [
                'choices'  => [
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ],
            ],
               'label' => 'Educateur'
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailEdus::class,
        ]);
    }
}

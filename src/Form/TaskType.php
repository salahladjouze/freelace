<?php

namespace App\Form;

use App\Entity\Tache;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TaskType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, $this->getConfiguration("titre",
            "Taper un  titre pour votre Tache"))
            ->add('slug',TextType::class,$this->getConfiguration("Adresse web",
             "Tapez l'adresse web (automatique)", ['required' => false]))
              ->add('categorie', ChoiceType::class, [
    'choices'  => [
             
        'Développement Web & Logiciel'=>  'Développement Web & Logiciel',
        'Science des données& Analitycs'=> 'Science des données& Analitycs',
        'Comptabilité & conseil'=> 'Comptabilité & conseil',
        'Rédaction & traductions'=> 'Rédaction & traductions',
        'Ventes & Marketing'=>  'Ventes & Marketing', 
        'Conception & graphisme'=>  'Conception & graphisme',
        'Le marketing & numérique' => 'Le marketing & numérique',
        'Education & formation' =>    'Education & formation',
        
        ],
     
])
            ->add('description',TextareaType::class, $this->getConfiguration("Description détaillé", 
            "Tapez une description détaillé de votre projet en spécifiant les technologies a utilisé et la durée de developpement maximale !"))
            ->add('heureDatePublication', DateTimeType::class, ['widget' => 'single_text'])
           
           
          ->add('budget',MoneyType::class, $this->getConfiguration("Budget", "Votre budget maximal"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}

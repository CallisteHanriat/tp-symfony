<?php
namespace App\Forms;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
 

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('director', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'name',
                 'query_builder' => function (EntityRepository $er) {
                     return $er->findAllOrderByName();
                 }])        
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class            
        ]);
    }
}

?>
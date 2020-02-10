<?php


namespace App\Form;


use App\Entity\Patient;
use App\Entity\Visit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class VisitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array  $options)
    {
        $builder
            ->add('startDate', DateTimeType::class,[
                'minutes' => [0],
                'hours' => [8,9,10,11,12,13,14,15]])
            ->add('doctor')
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visit::class,
        ]);
    }
}
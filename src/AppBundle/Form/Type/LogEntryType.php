<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\Type\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogEntryType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('exerciseName', TextType::class, array(
					'label' => false,
					'attr' => array(
             			'placeholder' => 'Exercise Name',
        			),
				))
            ->add('weight', TextType::class, array(
					'label' => false,
					'attr' => array(
             			'placeholder' => 'Weight',
        			),
				))
            ->add('sets', IntegerType::class, array(
					'label' => false,
					'attr' => array(
             			'placeholder' => 'Sets',
        			),
				))
            ->add('reps', TextType::class, array(
					'label' => false,
					'attr' => array(
             			'placeholder' => 'Reps',
        			),
				))
        	->add('category', ChoiceType::class, array(
		    		'choices' => array(
						'Cardio' => 'Cardio',
						'Strength Training' => 'Strength Training',
						'Other' => 'Other'
					),
					'label' => false,
				))
            ->add('save', SubmitType::class, array('label' => 'Save')
        );
    }

    public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => 'AppBundle\Entity\LogEntry',
	    ));
	}
}
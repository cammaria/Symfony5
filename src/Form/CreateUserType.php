<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, [
				'attr' => [
					'placeholder' => 'Prénom'
				]
			])
			->add('lastName', null, [
				'attr' => [
					'placeholder' => 'Nom'
				]
			])
			->add('email', null, [
				'attr' => [
					'placeholder' => 'Email'
				]
			])
            ->add('telephone', TelType::class, [
				'attr' => [
					'placeholder' => 'Téléphone fixe ou mobile'
				]
			])
			->add('gender', ChoiceType::class, [
				'choices' => [
					'Mme' => 0,
					'M' => 1,
					'Non binaire' => -1
				],
				'placeholder' => 'Civilité'
			])
			->add('newsletter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
			'csrf_protection' => false,
        ]);
		
    }
}

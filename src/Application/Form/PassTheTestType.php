<?php

declare(strict_types=1);

namespace App\Application\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PassTheTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        shuffle($options['questions']);
        foreach ($options['questions'] as $question) {
            $builder
                ->add(sprintf('%s', $question->getId()), ChoiceType::class, [
                    'label' => $question->getTitle(),
                    'choices' => $options['choices'][$question->getId()],
                    'required' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'choice_label' => 'title',
                    'choice_value' => 'id',
                    'expanded' => true,
                    'multiple' => true,
                ]);
        }

        $builder->add('save', SubmitType::class, ['attr' => ['class' => 'save']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'questions' => null,
            'choices' => null,
        ]);
    }
}

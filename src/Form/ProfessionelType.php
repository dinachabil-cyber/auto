<?php

namespace App\Form;

use App\Entity\Professionel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Validator\NoSpam;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ProfessionelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $productPlaceholder = match($options['product_type']) {
            'garage' => 'Nom de votre garage',
            'loueur' => 'Nom de votre entreprise de location',
            'auto_ecole' => 'Nom de votre auto-école',
            'negociants' => 'Nom de votre société',
            default => 'Raison sociale'
        };

        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(message: 'Le nom est obligatoire.'),
                    new Length(max: 255),
                    new Regex(pattern: '/^[\p{L} \-\'\’]+$/u', message: 'Le nom contient des caractères non autorisés.'),
                    new NoSpam(),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Nom *'
                ],
                'label' => false,
            ])
            ->add('prenom', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(message: 'Le prénom est obligatoire.'),
                    new Length(max: 255),
                    new Regex(pattern: '/^[\p{L} \-\'\’]+$/u', message: 'Le prénom contient des caractères non autorisés.'),
                    new NoSpam(),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Prénom *'
                ],
                'label' => false,
            ])
            ->add('raison_sociale', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(max: 255),
                    new NoSpam(),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Raison sociale'
                ],
                'label' => false,
            ])
            ->add('activite', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length(max: 255),
                    new NoSpam(),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Activité'
                ],
                'label' => false,
            ])
            ->add('assure', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Activité assurée actuellement',
                'choices' => ['Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'
                ],
                'label' => false,
            ])
            ->add('code_postal', TextType::class, [
                'required' => false,
                'constraints' => [new Length(max: 10)],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'maxlength' => 10,
                    'placeholder' => 'Code Postal'
                ],
                'label' => false,
            ])
            ->add('demarrage', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Démarrage activité',
                'choices' => ['Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'
                ],
                'label' => false,
            ])
            ->add('ancienne', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Ancienne Assurance résilié',
                'choices' => ['Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'
                ],
                'label' => false,
            ])
            ->add('motif', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Motif résiliation',
                'choices' => [
                    'Sinistre' => 'Sinistre',
                    'Non paiement' => 'Non paiement',
                    'Amiable' => 'Amiable',
                    'Échéance' => 'Échéance'
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'
                ],
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(message: 'L\'email est obligatoire.'),
                    new Email(message: 'Email invalide.'),
                    new NoSpam(),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Email *'
                ],
                'label' => false,
            ])
            ->add('tele', TelType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(message: 'Le téléphone est obligatoire.'),
                    new Regex(pattern: '/^0[1-9]([0-9]{2} ?){4}$/', message: 'Téléphone invalide (ex: 0612345678 ou 06 12 34 56 78).'),
                ],
                'attr' => [
                    'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none',
                    'placeholder' => 'Téléphone *'
                ],
                'label' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Comparer maintenant',
                'attr' => ['class' => 'w-full px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professionel::class,
            'product_type' => '',
            'attr' => ['novalidate' => 'novalidate', 'class' => 'space-y-4 flex-1 flex flex-col'],
        ]);
    }
}
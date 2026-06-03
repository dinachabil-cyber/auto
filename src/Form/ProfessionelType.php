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
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'Le nom est obligatoire.'),
                    new Length(max: 255),
                ],
                'attr' => ['placeholder' => 'Votre nom', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Nom *',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'Le prénom est obligatoire.'),
                    new Length(max: 255),
                ],
                'attr' => ['placeholder' => 'Votre prénom', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Prénom *',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('raison_sociale', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => $productPlaceholder, 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Raison sociale',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('activite', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Votre activité', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Activité',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('assure', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez un statut…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Activité assurée actuellement',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('code_postal', TextType::class, [
                'required' => false,
                'constraints' => [new Length(max: 10)],
                'attr' => ['placeholder' => '75001', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none', 'maxlength' => 10],
                'label' => 'Code Postal',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('demarrage', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez le statut…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Démarrage activité',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('ancienne', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez une option…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Ancienne Assurance résilié',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('motif', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez un motif…' => '', 'Sinistre' => 'Sinistre', 'Non paiement' => 'Non paiement', 'Amiable' => 'Amiable', 'Échéance' => 'Échéance'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Motif résiliation',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'L\'email est obligatoire.'),
                    new Email(message: 'Email invalide.'),
                ],
                'attr' => ['placeholder' => 'email@exemple.com', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Email *',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('tele', TelType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(message: 'Le téléphone est obligatoire.'),
                    new Regex(pattern: '/^0[1-9]([0-9]{2} ?){4}$/', message: 'Téléphone invalide (ex: 0612345678 ou 06 12 34 56 78).'),
                ],
                'attr' => ['placeholder' => '06 12 34 56 78', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Téléphone *',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
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
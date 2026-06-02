<?php

namespace App\Form;

use App\Entity\AutoEcoleDevi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class AutoEcoleDeviType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
                'attr' => ['placeholder' => 'Nom de votre auto-école', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Raison sociale',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('activite', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Votre activité', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Activité',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('demarrage', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Démarrage d\'activité',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('assure', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Déjà assuré(e) ?',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('ancienne', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez…' => '', 'Oui' => 'OUI', 'Non' => 'NON'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Ancienne assurance résiliée ?',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('motif_resiliation', ChoiceType::class, [
                'required' => false,
                'choices' => ['Sélectionnez…' => '', 'Sinistre' => 'Sinistre', 'Non paiement' => 'Non paiement', 'Amiable' => 'Amiable', 'Échéance' => 'Échéance'],
                'attr' => ['class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none cursor-pointer'],
                'label' => 'Motif de résiliation',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('code_postal', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Regex(pattern: '/^[0-9]{5}$/', message: 'Code postal invalide (5 chiffres).'),
                ],
                'attr' => ['placeholder' => 'Code postal', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none', 'maxlength' => 5, 'inputmode' => 'numeric'],
                'label' => 'Code postal',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('telephone', TelType::class, [
                'required' => false,
                'constraints' => [
                    new Regex(pattern: '/^0[1-9][0-9]{8}$/', message: 'Téléphone invalide (10 chiffres).'),
                ],
                'attr' => ['placeholder' => '01 23 45 67 89', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none', 'maxlength' => 10],
                'label' => 'Téléphone',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'constraints' => [
                    new Email(message: 'Email invalide.'),
                ],
                'attr' => ['placeholder' => 'email@exemple.com', 'class' => 'w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 outline-none'],
                'label' => 'Email',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-700 mb-1.5'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Comparer maintenant',
                'attr' => ['class' => 'w-full px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl transition-all'],
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();
            
            if ($data->getAncienne() === 'OUI' && ($data->getMotifResiliation() === null || $data->getMotifResiliation() === '')) {
                $form->get('motif_resiliation')->addConstraint(new NotBlank(message: 'Le motif de résiliation est obligatoire.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AutoEcoleDevi::class,
            'attr' => ['novalidate' => 'novalidate', 'class' => 'space-y-4 flex-1 flex flex-col'],
        ]);
    }
}
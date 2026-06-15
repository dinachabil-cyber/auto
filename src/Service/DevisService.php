<?php

namespace App\Service;

use App\Entity\Professionel;
use App\Validator\NoSpam;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DevisService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
    ) {}

    /**
     * Create a professionel devis from form data
     */
    public function createProfessionel(FormInterface $form): Professionel
    {
        $entity = $form->getData();
        $this->handleAncienneAssurance($entity);

        $violations = $this->validator->validate($entity, null, ['Default']);

        $spamViolations = new ConstraintViolationList();
        foreach ($violations as $violation) {
            $constraint = $violation->getConstraint();
            if ($constraint instanceof NoSpam) {
                $spamViolations->add($violation);
            }
        }

        foreach ($spamViolations as $violation) {
            $form->get($violation->getPropertyPath())?->addError(
                new \Symfony\Component\Form\FormError($violation->getMessage())
            );
        }

        if (count($spamViolations) > 0) {
            $form->addError(new \Symfony\Component\Form\FormError('Contenu suspect détecté. Merci de corriger votre saisie.'));
            throw new \RuntimeException('SPAM_DETECTED');
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * Set motif to NULL when ancienne assurance is not résiliée (NON)
     */
    private function handleAncienneAssurance(object $entity): void
    {
        if (method_exists($entity, 'getAncienne') && method_exists($entity, 'setMotif')) {
            $ancienne = $entity->getAncienne();
            if ($ancienne !== 'OUI') {
                $entity->setMotif(null);
            }
        }
    }
}

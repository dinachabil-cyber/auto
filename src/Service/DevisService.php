<?php

namespace App\Service;

use App\Entity\AutoEcoleDevi;
use App\Entity\GarageDevi;
use App\Entity\LoueurDevi;
use App\Entity\NegociantsDevi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class DevisService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * Create a general devis from form data
     */
    public function createDevi(FormInterface $form): mixed
    {
        $devi = $form->getData();
        $this->handleAncienneAssurance($devi);
        $this->entityManager->persist($devi);
        $this->entityManager->flush();
        return $devi;
    }

    /**
     * Create a garage devis from form data
     */
    public function createGarageDevi(FormInterface $form): GarageDevi
    {
        return $this->createDeviCommon($form);
    }

    /**
     * Create a loueur devis from form data
     */
    public function createLoueurDevi(FormInterface $form): LoueurDevi
    {
        return $this->createDeviCommon($form);
    }

    /**
     * Create a negociants devis from form data
     */
    public function createNegociantsDevi(FormInterface $form): NegociantsDevi
    {
        return $this->createDeviCommon($form);
    }

    /**
     * Create an auto-école devis from form data
     */
    public function createAutoEcoleDevi(FormInterface $form): AutoEcoleDevi
    {
        return $this->createDeviCommon($form);
    }

    /**
     * Common method to persist any devis entity
     */
    private function createDeviCommon(FormInterface $form): mixed
    {
        $entity = $form->getData();
        $this->handleAncienneAssurance($entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    /**
     * Set motif_resiliation to NULL when ancienne assurance is not résiliée (NON)
     */
    private function handleAncienneAssurance(object $entity): void
    {
        if (method_exists($entity, 'getAncienne') && method_exists($entity, 'setMotifResiliation')) {
            $ancienne = $entity->getAncienne();
            if ($ancienne !== 'OUI') {
                $entity->setMotifResiliation(null);
            }
        }
    }
}
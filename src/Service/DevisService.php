<?php

namespace App\Service;

use App\Entity\Professionel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class DevisService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * Create a professionel devis from form data
     */
    public function createProfessionel(FormInterface $form): Professionel
    {
        $entity = $form->getData();
        $this->handleAncienneAssurance($entity);
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
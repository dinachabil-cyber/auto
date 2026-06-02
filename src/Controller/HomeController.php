<?php

namespace App\Controller;

use App\Entity\AutoEcoleDevi;
use App\Entity\Devi;
use App\Entity\GarageDevi;
use App\Entity\LoueurDevi;
use App\Entity\NegociantsDevi;
use App\Form\AutoEcoleDeviType;
use App\Form\DeviType;
use App\Form\GarageDeviType;
use App\Form\LoueurDeviType;
use App\Form\NegociantsDeviType;
use App\Service\DevisService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    // =========================
    // HOME
    // =========================
    #[Route('/', name: 'app_home')]
    public function index(Request $request, DevisService $devisService): Response
    {
        $devi = new Devi();
        $form = $this->createForm(DeviType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $devisService->createDevi($form);

            $this->addFlash('success', 'Demande envoyée avec succès');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // =========================
    // NEGOCIANTS
    // =========================
    #[Route('/negociants-auto', name: 'app_negociants')]
    public function negociants(Request $request, DevisService $devisService): Response
    {
        $entity = new NegociantsDevi();
        $form = $this->createForm(NegociantsDeviType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $devisService->createNegociantsDevi($form);

            $this->addFlash('success', 'Demande négociant envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        return $this->render('negociants/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // =========================
    // AUTO ECOLE
    // =========================
    #[Route('/auto-ecole', name: 'app_auto_ecole')]
    public function autoEcole(Request $request, DevisService $devisService): Response
    {
        $entity = new AutoEcoleDevi();
        $form = $this->createForm(AutoEcoleDeviType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $devisService->createAutoEcoleDevi($form);

            $this->addFlash('success', 'Demande auto-école envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        return $this->render('autoecole/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // =========================
    // LOUEUR
    // =========================
    #[Route('/loueur-voiture', name: 'app_loueur')]
    public function loueur(Request $request, DevisService $devisService): Response
    {
        $entity = new LoueurDevi();
        $form = $this->createForm(LoueurDeviType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $devisService->createLoueurDevi($form);

            $this->addFlash('success', 'Demande loueur envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        return $this->render('loueur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // =========================
    // GARAGE
    // =========================
    #[Route('/garage-automobile', name: 'app_garage')]
    public function garage(Request $request, DevisService $devisService): Response
    {
        $entity = new GarageDevi();
        $form = $this->createForm(GarageDeviType::class, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entity = $devisService->createGarageDevi($form);

            $this->addFlash('success', 'Demande garage envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        return $this->render('garage/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // =========================
    // CONFIRMATION PAGE
    // =========================
    #[Route('/devis/{id}/confirmation', name: 'app_confirmation')]
    public function confirmation(int $id): Response
    {
        return $this->render('confirmation/index.html.twig', [
            'id' => $id
        ]);
    }

    // =========================
    // LEGAL PAGES
    // =========================
    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('mentions_legales/index.html.twig');
    }

    #[Route('/politique-confidentialite', name: 'app_politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('politique_confidentialite/index.html.twig');
    }
}
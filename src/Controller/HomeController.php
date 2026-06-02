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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route; 

class HomeController extends AbstractController
{
    // ============================================================================
    // HOMEPAGE
    // ============================================================================
    
    #[Route('/', name: 'app_home')]
    public function index(Request $request, DevisService $devisService): Response
    {
        $devi = new Devi();
        $form = $this->createForm(DeviType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisService->createDevi($form);

            $this->addFlash('success', 'Votre demande de devis a bien été enregistrée.');

            return new RedirectResponse($this->generateUrl('app_home'));
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ============================================================================
    // NÉGOCIANTS AUTOMOBILE
    // ============================================================================
    
    #[Route('/negociants-auto', name: 'app_negociants')]
    public function négociants(Request $request, DevisService $devisService): Response
    {
        $negociantsDevi = new NegociantsDevi();
        $form = $this->createForm(NegociantsDeviType::class, $negociantsDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisService->createNegociantsDevi($form);

            $this->addFlash('success', 'Votre demande de devis négociant a bien été enregistrée.');

            return new RedirectResponse($this->generateUrl('app_negociants'));
        }

        return $this->render('negociants/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ============================================================================
    // AUTO-ÉCOLE
    // ============================================================================
    
    #[Route('/auto-ecole', name: 'app_auto_ecole')]
    public function autoEcole(Request $request, DevisService $devisService): Response
    {
        $autoEcoleDevi = new AutoEcoleDevi();
        $form = $this->createForm(AutoEcoleDeviType::class, $autoEcoleDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisService->createAutoEcoleDevi($form);

            $this->addFlash('success', 'Votre demande de devis auto-école a bien été enregistrée.');

            return new RedirectResponse($this->generateUrl('app_auto_ecole'));
        }

        return $this->render('autoecole/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ============================================================================
    // LOUEUR DE VÉHICULES
    // ============================================================================
    
    #[Route('/loueur-voiture', name: 'app_loueur')]
    public function loueur(Request $request, DevisService $devisService): Response
    {
        $loueurDevi = new LoueurDevi();
        $form = $this->createForm(LoueurDeviType::class, $loueurDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisService->createLoueurDevi($form);

            $this->addFlash('success', 'Votre demande de devis loueur a bien été enregistrée.');

            return new RedirectResponse($this->generateUrl('app_loueur'));
        }

        return $this->render('loueur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ============================================================================
    // GARAGE AUTOMOBILE
    // ============================================================================
    
    #[Route('/garage-automobile', name: 'app_garage')]
    public function garage(Request $request, DevisService $devisService): Response
    {
        $garageDevi = new GarageDevi();
        $form = $this->createForm(GarageDeviType::class, $garageDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisService->createGarageDevi($form);

            $this->addFlash('success', 'Votre demande de devis garage a bien été enregistrée.');

            return new RedirectResponse($this->generateUrl('app_garage'));
        }

        return $this->render('garage/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // ============================================================================
    // CONFIRMATION PAGE
    // ============================================================================
    
    #[Route('/devis/{id}/confirmation', name: 'app_confirmation')]
    public function confirmation(int $id): Response
    {
        return $this->render('confirmation/index.html.twig', [
            'id' => $id,
        ]);
    }

    // ============================================================================
    // PAGES LÉGALES
    // ============================================================================
    
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
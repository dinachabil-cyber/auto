<?php

namespace App\Controller;

use App\Entity\Professionel;
use App\Form\ProfessionelType;
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
        $entity = new Professionel();
        $form = $this->createForm(ProfessionelType::class, $entity, ['product_type' => 'general']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $devisService->createProfessionel($form);
            $this->addFlash('success', 'Demande envoyée avec succès');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        $response = $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setStatusCode(422);
        }

        return $response;
    }


    // =========================
    // NEGOCIANTS
    // =========================
    #[Route('/negociants-auto', name: 'app_negociants')]
    public function negociants(Request $request, DevisService $devisService): Response
    {
        $entity = new Professionel();
        $entity->setProduct('negociants');
        $form = $this->createForm(ProfessionelType::class, $entity, ['product_type' => 'negociants']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $devisService->createProfessionel($form);
            $this->addFlash('success', 'Demande négociant envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        $response = $this->render('negociants/index.html.twig', [
            'form' => $form->createView(),
        ]);

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setStatusCode(422);
        }

        return $response;
    }

    // =========================
    // AUTO ECOLE
    // =========================
    #[Route('/auto-ecole', name: 'app_auto_ecole')]
    public function autoEcole(Request $request, DevisService $devisService): Response
    {
        $entity = new Professionel();
        $entity->setProduct('auto_ecole');
        $form = $this->createForm(ProfessionelType::class, $entity, ['product_type' => 'auto_ecole']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $devisService->createProfessionel($form);
            $this->addFlash('success', 'Demande auto-école envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        $response = $this->render('autoecole/index.html.twig', [
            'form' => $form->createView(),
        ]);

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setStatusCode(422);
        }

        return $response;
    }

    // =========================
    // LOUEUR
    // =========================
    #[Route('/loueur-voiture', name: 'app_loueur')]
    public function loueur(Request $request, DevisService $devisService): Response
    {
        $entity = new Professionel();
        $entity->setProduct('loueur');
        $form = $this->createForm(ProfessionelType::class, $entity, ['product_type' => 'loueur']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $devisService->createProfessionel($form);
            $this->addFlash('success', 'Demande loueur envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        $response = $this->render('loueur/index.html.twig', [
            'form' => $form->createView(),
        ]);

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setStatusCode(422);
        }

        return $response;
    }

    // =========================
    // GARAGE
    // =========================
    #[Route('/garage-automobile', name: 'app_garage')]
    public function garage(Request $request, DevisService $devisService): Response
    {
        $entity = new Professionel();
        $entity->setProduct('garage');
        $form = $this->createForm(ProfessionelType::class, $entity, ['product_type' => 'garage']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $devisService->createProfessionel($form);
            $this->addFlash('success', 'Demande garage envoyée');

            return $this->redirectToRoute('app_confirmation', [
                'id' => $entity->getId()
            ]);
        }

        $response = $this->render('garage/index.html.twig', [
            'form' => $form->createView(),
        ]);

        if ($form->isSubmitted() && !$form->isValid()) {
            $response->setStatusCode(422);
        }

        return $response;
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
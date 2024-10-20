<?php

namespace App\Controller;

use App\Entity\VehiculeConcessionnaire;
use App\Form\VehiculeConcessionnaireType;
use App\Repository\VehiculeConcessionnaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vehicule/concessionnaire')]
final class VehiculeConcessionnaireController extends AbstractController
{
    #[Route(name: 'app_vehicule_concessionnaire_index', methods: ['GET'])]
    public function index(VehiculeConcessionnaireRepository $vehiculeConcessionnaireRepository): Response
    {
        return $this->render('vehicule_concessionnaire/index.html.twig', [
            'vehicule_concessionnaires' => $vehiculeConcessionnaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vehicule_concessionnaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehiculeConcessionnaire = new VehiculeConcessionnaire();
        $form = $this->createForm(VehiculeConcessionnaireType::class, $vehiculeConcessionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehiculeConcessionnaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicule_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vehicule_concessionnaire/new.html.twig', [
            'vehicule_concessionnaire' => $vehiculeConcessionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicule_concessionnaire_show', methods: ['GET'])]
    public function show(VehiculeConcessionnaire $vehiculeConcessionnaire): Response
    {
        return $this->render('vehicule_concessionnaire/show.html.twig', [
            'vehicule_concessionnaire' => $vehiculeConcessionnaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vehicule_concessionnaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VehiculeConcessionnaire $vehiculeConcessionnaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehiculeConcessionnaireType::class, $vehiculeConcessionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicule_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vehicule_concessionnaire/edit.html.twig', [
            'vehicule_concessionnaire' => $vehiculeConcessionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicule_concessionnaire_delete', methods: ['POST'])]
    public function delete(Request $request, VehiculeConcessionnaire $vehiculeConcessionnaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehiculeConcessionnaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vehiculeConcessionnaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vehicule_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
    }
}

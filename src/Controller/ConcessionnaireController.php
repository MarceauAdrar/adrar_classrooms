<?php

namespace App\Controller;

use App\Entity\Concessionnaire;
use App\Form\ConcessionnaireType;
use App\Repository\ConcessionnaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/concessionnaire')]
final class ConcessionnaireController extends AbstractController
{
    #[Route(name: 'app_concessionnaire_index', methods: ['GET'])]
    public function index(ConcessionnaireRepository $concessionnaireRepository): Response
    {
        return $this->render('concessionnaire/index.html.twig', [
            'concessionnaires' => $concessionnaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_concessionnaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $concessionnaire = new Concessionnaire();
        $form = $this->createForm(ConcessionnaireType::class, $concessionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($concessionnaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('concessionnaire/new.html.twig', [
            'concessionnaire' => $concessionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_concessionnaire_show', methods: ['GET'])]
    public function show(Concessionnaire $concessionnaire): Response
    {
        return $this->render('concessionnaire/show.html.twig', [
            'concessionnaire' => $concessionnaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_concessionnaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Concessionnaire $concessionnaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConcessionnaireType::class, $concessionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('concessionnaire/edit.html.twig', [
            'concessionnaire' => $concessionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_concessionnaire_delete', methods: ['POST'])]
    public function delete(Request $request, Concessionnaire $concessionnaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concessionnaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($concessionnaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_concessionnaire_index', [], Response::HTTP_SEE_OTHER);
    }
}

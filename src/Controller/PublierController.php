<?php

namespace App\Controller;

use App\Entity\Publier;
use App\Form\PublierType;
use App\Repository\PublierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/publier')]
class PublierController extends AbstractController
{
    #[Route('/', name: 'app_publier_index', methods: ['GET'])]
    public function index(PublierRepository $publierRepository): Response
    {
        return $this->render('publier/index.html.twig', [
            'publiers' => $publierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_publier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publier = new Publier();
        $form = $this->createForm(PublierType::class, $publier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($publier);
            $entityManager->flush();

            return $this->redirectToRoute('app_publier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publier/new.html.twig', [
            'publier' => $publier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_publier_show', methods: ['GET'])]
    public function show(Publier $publier): Response
    {
        return $this->render('publier/show.html.twig', [
            'publier' => $publier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_publier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Publier $publier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PublierType::class, $publier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_publier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publier/edit.html.twig', [
            'publier' => $publier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_publier_delete', methods: ['POST'])]
    public function delete(Request $request, Publier $publier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($publier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_publier_index', [], Response::HTTP_SEE_OTHER);
    }
}

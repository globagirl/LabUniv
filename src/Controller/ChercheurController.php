<?php

namespace App\Controller;

use App\Entity\Chercheur;
use App\Form\ChercheurType;
use App\Repository\ChercheurRepository;
use Doctrine\ORM\EntityManagerInterface;
use PharIo\Manifest\ElementCollectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chercheur')]
class ChercheurController extends AbstractController
{
    #[Route('/', name: 'app_chercheur_index', methods: ['GET'])]
    public function index(ChercheurRepository $chercheurRepository): Response
    {
        return $this->render('chercheur/index.html.twig', [
            'chercheurs' => $chercheurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chercheur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager):Response
    {
        $chercheur = new Chercheur();
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager->persist($chercheur);
//            $entityManager->flush();
            if($chercheur->getSupno() != null){
                $p_supno=$chercheur->getSupno()->getId();
            }else{
                $p_supno=null;
            }


            $sql = 'call AJOUT_CHERCHEUR(:p_chnom, :p_grade, :p_statut, :p_daterecrut, :p_salaire,
        :p_prime, :p_email,:p_supno, :p_labno, :p_facno)';

            $stmt = $entityManager->getConnection()->prepare($sql);
            $stmt->executeQuery([
                ':p_chnom'=>$chercheur->getChnom(),
                ':p_grade'=>$chercheur->getGrade(),
                ':p_statut'=>$chercheur->getStatus(),
                ':p_daterecrut'=>$chercheur->getDaterecrut(),
                ':p_salaire'=>$chercheur->getSalaire(),
                ':p_prime'=>$chercheur->getPrime(),
                ':p_email'=>$chercheur->getEmail(),
                ':p_supno'=>$p_supno,
                ':p_labno'=>$chercheur->getLabno()->getId(),
                ':p_facno'=>$chercheur->getFacno()->getId()
            ]);

//            $sql = 'call AJOUT_CHERCHEUR(:p_chnom, :p_grade, :p_statut, :p_daterecrut, :p_salaire,
//        :p_prime, :p_email,:p_supno, :p_labno, :p_facno)';
//            $stmt = $entityManager->getConnection()->prepare($sql);
//            $stmt->executeQuery([
//                ':p_chnom'=>'anis',
//                ':p_grade'=>'D',
//                ':p_statut'=>'C',
//                ':p_daterecrut'=>'2022-01-01',
//                ':p_salaire'=>600,
//                ':p_prime'=>150,
//                ':p_email'=>'anis24@gmail.com',
//                ':p_supno'=>null,
//                ':p_labno'=>'dev',
//                ':p_facno'=>'test'
//            ]);

            return $this->redirectToRoute('app_chercheur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chercheur/new.html.twig', [
            'chercheur' => $chercheur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chercheur_show', methods: ['GET'])]
    public function show(Chercheur $chercheur): Response
    {
        return $this->render('chercheur/show.html.twig', [
            'chercheur' => $chercheur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chercheur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chercheur $chercheur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chercheur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chercheur/edit.html.twig', [
            'chercheur' => $chercheur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chercheur_delete', methods: ['POST'])]
    public function delete(Request $request, Chercheur $chercheur, EntityManagerInterface $entityManager): Response
    {
//        if ($this->isCsrfTokenValid('delete'.$chercheur->getId(), $request->request->get('_token'))) {
//            $entityManager->remove($chercheur);
//            $entityManager->flush();
//        }

        $sql = 'call DELETE_chercheur(:p_id)';
        $stmt = $entityManager->getConnection()->prepare($sql);
        $stmt->executeQuery([
            ':p_id'=>$chercheur->getId()
        ]);

        return $this->redirectToRoute('app_chercheur_index', [], Response::HTTP_SEE_OTHER);
    }
}

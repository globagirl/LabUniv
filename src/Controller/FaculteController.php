<?php

namespace App\Controller;

use App\Entity\Faculte;
use App\Form\FaculteType;
use App\Repository\FaculteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\DBAL\Driver\Connection;

#[Route('/faculte')]
class FaculteController extends AbstractController
{
    public function showQuery(Request $request, Connection $conn){
        /*
         $group = $conn->fetchAssoc(
             'SELECT CUST_NAME FROM CUSTOMER WHERE CUST_ID=290'
         );*/
    }

    //how to call oracle stored procedure
    //$sql = "CALL namespace.my_proc(".$data_source_id.", to_date('".$account_period_start."', 'YYYY-MM-DD'),'".$updated_by."', :x, :y)";
    //$stmt = $this->getDoctrine()->getManager('fdw')->getConnection()->prepare($sql);
    //$stmt->bindParam(':x', $x, \PDO::PARAM_INPUT_OUTPUT, 32);
    //$stmt->bindParam(':y', $y, \PDO::PARAM_INPUT_OUTPUT, 32);
    //$result = $stmt->execute();


    #[Route('/', name: 'app_faculte_index', methods: ['GET'])]
    public function index(FaculteRepository $faculteRepository): Response
    {
        return $this->render('faculte/index.html.twig', [
            'facultes' => $faculteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_faculte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $faculte = new Faculte();
        $form = $this->createForm(FaculteType::class, $faculte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($faculte);
            $entityManager->flush();

            return $this->redirectToRoute('app_faculte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('faculte/new.html.twig', [
            'faculte' => $faculte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_faculte_show', methods: ['GET'])]
    public function show(Faculte $faculte): Response
    {
        return $this->render('faculte/show.html.twig', [
            'faculte' => $faculte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_faculte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Faculte $faculte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FaculteType::class, $faculte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_faculte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('faculte/edit.html.twig', [
            'faculte' => $faculte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_faculte_delete', methods: ['POST'])]
    public function delete(Request $request, Faculte $faculte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$faculte->getId(), $request->request->get('_token'))) {
            $entityManager->remove($faculte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_faculte_index', [], Response::HTTP_SEE_OTHER);
    }
}

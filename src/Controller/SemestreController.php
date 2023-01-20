<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Semestre;
use App\Form\CoursType;
use App\Form\SemestreType;
use App\Repository\CoursRepository;
use App\Repository\SemestreRepository;
use cebe\markdown\Markdown;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/semestre')]
class SemestreController extends AbstractController
{
    #[Route('/', name: 'app_semestre_index', methods: ['GET'])]
    public function index(SemestreRepository $semestreRepository): Response
    {
        $semestres = $semestreRepository->findAll();
        return $this->render('semestre/index.html.twig', [
            'semestres' => $semestres
        ]);
    }

    #[Route('/{id}/coursList', name: 'app_semestre_show_cours', methods: ['GET'])]
    public function show(int $id, SemestreRepository $semestreRepository, CoursRepository $coursRepository): Response
    {
        $semestre = $semestreRepository->find($id);
        $cours = $coursRepository->findBySemestre($semestre);
        return $this->render('semestre/show.html.twig', [
            'semestre' => $semestre,
            'cours' => $cours,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_semestre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Semestre $semestre, SemestreRepository $semestreRepository): Response
    {
        $form = $this->createForm(SemestreType::class, $semestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $semestreRepository->save($semestre, true);

            return $this->redirectToRoute('app_semestre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('semestre/edit.html.twig', [
            'semestre' => $semestre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_semestre_delete', methods: ['POST'])]
    public function delete(Request $request, Semestre $semestre, SemestreRepository $semestreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semestre->getId(), $request->request->get('_token'))) {
            $semestreRepository->remove($semestre, true);
        }

        return $this->redirectToRoute('app_semestre_index', [], Response::HTTP_SEE_OTHER);
    }
}

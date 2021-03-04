<?php

namespace App\Controller;

use App\Entity\Targets;
use App\Form\TargetsType;
use App\Repository\TargetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/targets")
 */
class TargetsController extends AbstractController
{
    /**
     * @Route("/", name="app.targets.index", methods={"GET"})
     */
    public function index(TargetsRepository $targetsRepository): Response
    {
        return $this->render('targets/index.html.twig', [
            'targets' => $targetsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="targets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $target = new Targets();
        $form = $this->createForm(TargetsType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($target);
            $entityManager->flush();

            return $this->redirectToRoute('app.targets.index');
        }

        return $this->render('targets/new.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app.targets.show", methods={"GET"})
     */
    public function show(Targets $target): Response
    {
        return $this->render('targets/show.html.twig', [
            'target' => $target,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app.targets.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Targets $target): Response
    {
        $form = $this->createForm(TargetsType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app.targets.index');
        }

        return $this->render('targets/edit.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app.targets.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Targets $target): Response
    {
        if ($this->isCsrfTokenValid('delete' . $target->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($target);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app.targets.index');
    }
}

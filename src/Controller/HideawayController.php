<?php

namespace App\Controller;

use App\Entity\Hideaway;
use App\Form\HideawayType;
use App\Repository\HideawayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hideaway")
 */
class HideawayController extends AbstractController
{
    /**
     * @Route("/", name="hideaway_index", methods={"GET"})
     */
    public function index(HideawayRepository $hideawayRepository): Response
    {
        return $this->render('hideaway/index.html.twig', [
            'hideaways' => $hideawayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hideaway_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hideaway = new Hideaway();
        $form = $this->createForm(HideawayType::class, $hideaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hideaway);
            $entityManager->flush();

            return $this->redirectToRoute('hideaway_index');
        }

        return $this->render('hideaway/new.html.twig', [
            'hideaway' => $hideaway,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hideaway_show", methods={"GET"})
     */
    public function show(Hideaway $hideaway): Response
    {
        return $this->render('hideaway/show.html.twig', [
            'hideaway' => $hideaway,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hideaway_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hideaway $hideaway): Response
    {
        $form = $this->createForm(HideawayType::class, $hideaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hideaway_index');
        }

        return $this->render('hideaway/edit.html.twig', [
            'hideaway' => $hideaway,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hideaway_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hideaway $hideaway): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hideaway->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hideaway);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hideaway_index');
    }
}

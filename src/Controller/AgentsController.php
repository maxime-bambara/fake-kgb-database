<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentsType;
use App\Repository\AgentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/agents")
 */
class AgentsController extends AbstractController
{
    /**
     * @Route("/", name="agents_index", methods={"GET"})
     */
    public function index(AgentsRepository $agentsRepository): Response
    {
        return $this->render('agents/index.html.twig', [
            'agents' => $agentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="agents_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agent = new Agents();
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agent);
            $entityManager->flush();

            return $this->redirectToRoute('agents_index');
        }

        return $this->render('agents/new.html.twig', [
            'agent' => $agent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agents_show", methods={"GET"})
     */
    public function show(Agents $agent): Response
    {
        return $this->render('agents/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="agents_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Agents $agent): Response
    {
        $form = $this->createForm(AgentsType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agents_index');
        }

        return $this->render('agents/edit.html.twig', [
            'agent' => $agent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agents_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Agents $agent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agents_index');
    }
}

<?php

namespace App\Controller;

require __DIR__ . '/../../vendor/autoload.php';

use App\Entity\Missions;
use App\Form\MissionsType;
use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MissionsController extends AbstractController
{
    /**
     * @Route("/", name="app.home", methods={"GET"})
     * 
     */
    public function index(MissionsRepository $missionsRepository): Response
    {
        return $this->render('missions/index.html.twig', [
            'missions' => $missionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/missions/new", name="app.missions.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mission = new Missions();
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->missionIsValid()) {
                $this->addFlash('error', 'Your mission does not contain valids items. Please check the following: Agent(s) skill(s) / Nationality of agents or contacts / Hideaway country');
                return $this->redirectToRoute('app.home');;
            };
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('app.home');
        }

        return $this->render('missions/new.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/missions/{id}", name="app.missions.show", methods={"GET"})
     */
    public function show(Missions $mission): Response
    {
        return $this->render('missions/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    /**
     * @Route("/missions/{id}/edit", name="app.missions.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Missions $mission): Response
    {
        $form = $this->createForm(MissionsType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->missionIsValid()) {
                $this->addFlash('error', 'Your mission does not contain valids items. Please check the following: Agent(s) skill(s) / Nationality of agents or contacts / Hideaway country');
                return $this->redirectToRoute('app.home');;
            };

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app.home');
        }

        return $this->render('missions/edit.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/missions/{id}", name="app.missions.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Missions $mission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app.home');
    }
}

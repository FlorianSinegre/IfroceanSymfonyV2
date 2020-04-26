<?php

namespace App\Controller;

use App\Entity\Plage;
use App\Form\PlageType;
use App\Repository\PlageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plage")
 */
class PlageController extends AbstractController
{
    /**
     * @Route("/", name="plage_index", methods={"GET"})
     */
    public function index(PlageRepository $plageRepository): Response
    {
        return $this->render('plage/index.html.twig', [
            'plages' => $plageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plage = new Plage();
        $form = $this->createForm(PlageType::class, $plage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plage);
            $entityManager->flush();

            return $this->redirectToRoute('plage_index');
        }

        return $this->render('plage/new.html.twig', [
            'plage' => $plage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plage_show", methods={"GET"})
     */
    public function show(Plage $plage): Response
    {
        return $this->render('plage/show.html.twig', [
            'plage' => $plage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plage $plage): Response
    {
        $form = $this->createForm(PlageType::class, $plage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plage_index');
        }

        return $this->render('plage/edit.html.twig', [
            'plage' => $plage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plage $plage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plage_index');
    }
}

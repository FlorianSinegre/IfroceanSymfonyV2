<?php

namespace App\Controller;

use App\Entity\Etude;
use App\Entity\Plage;
use App\Form\EtudeType;
use App\Repository\EtudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etude")
 */
class EtudeController extends AbstractController
{
    /**
     * @Route("/", name="etude_index", methods={"GET"})
     */
    public function index(EtudeRepository $etudeRepository): Response
    {
        return $this->render('etude/index.html.twig', [
            'etudes' => $etudeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etude_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etude = new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etude);
            $entityManager->flush();

            return $this->redirectToRoute('etude_index');
        }

        return $this->render('etude/new.html.twig', [
            'etude' => $etude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etude_show", methods={"GET"})
     */
    public function show(Etude $etude): Response
    {
        $plage = $this->getDoctrine()->getRepository(Plage::class)->findAll();
        return $this->render('etude/show.html.twig', [
            'etude' => $etude,
            'plage' => $plage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etude_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etude $etude): Response
    {
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etude_index');
        }

        return $this->render('etude/edit.html.twig', [
            'etude' => $etude,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etude_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etude $etude): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etude->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etude_index');
    }
}

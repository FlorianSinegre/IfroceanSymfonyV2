<?php

namespace App\Controller;

use App\Entity\Espece;
use App\Form\EspeceType;
use App\Repository\EspeceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espece")
 */
class EspeceController extends AbstractController
{
    /**
     * @Route("/", name="espece_index", methods={"GET"})
     */
    public function index(EspeceRepository $especeRepository): Response
    {
        return $this->render('espece/index.html.twig', [
            'especes' => $especeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="espece_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $espece = new Espece();
        $form = $this->createForm(EspeceType::class, $espece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($espece);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('espece/new.html.twig', [
            'espece' => $espece,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espece_show", methods={"GET"})
     */
    public function show(Espece $espece): Response
    {
        return $this->render('espece/show.html.twig', [
            'espece' => $espece,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="espece_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Espece $espece): Response
    {
        $form = $this->createForm(EspeceType::class, $espece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('espece_index');
        }

        return $this->render('espece/edit.html.twig', [
            'espece' => $espece,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espece_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Espece $espece): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espece->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($espece);
            $entityManager->flush();
        }

        return $this->redirectToRoute('espece_index');
    }
}

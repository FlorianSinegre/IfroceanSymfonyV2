<?php

namespace App\Controller;

use App\Entity\ZoneDePrelevement;
use App\Form\ZoneDePrelevementType;
use App\Repository\ZoneDePrelevementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/zone/de/prelevement")
 */
class ZoneDePrelevementController extends AbstractController
{
    /**
     * @Route("/", name="zone_de_prelevement_index", methods={"GET"})
     */
    public function index(ZoneDePrelevementRepository $zoneDePrelevementRepository): Response
    {
        return $this->render('zone_de_prelevement/index.html.twig', [
            'zone_de_prelevements' => $zoneDePrelevementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="zone_de_prelevement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $zoneDePrelevement = new ZoneDePrelevement();
        $form = $this->createForm(ZoneDePrelevementType::class, $zoneDePrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zoneDePrelevement);
            $entityManager->flush();

            return $this->redirectToRoute('zone_de_prelevement_index');
        }

        return $this->render('zone_de_prelevement/new.html.twig', [
            'zone_de_prelevement' => $zoneDePrelevement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zone_de_prelevement_show", methods={"GET"})
     */
    public function show(ZoneDePrelevement $zoneDePrelevement): Response
    {
        return $this->render('zone_de_prelevement/show.html.twig', [
            'zone_de_prelevement' => $zoneDePrelevement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="zone_de_prelevement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ZoneDePrelevement $zoneDePrelevement): Response
    {
        $form = $this->createForm(ZoneDePrelevementType::class, $zoneDePrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('zone_de_prelevement_index');
        }

        return $this->render('zone_de_prelevement/edit.html.twig', [
            'zone_de_prelevement' => $zoneDePrelevement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="zone_de_prelevement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ZoneDePrelevement $zoneDePrelevement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zoneDePrelevement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($zoneDePrelevement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('zone_de_prelevement_index');
    }
}

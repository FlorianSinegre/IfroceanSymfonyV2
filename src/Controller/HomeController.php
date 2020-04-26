<?php

namespace App\Controller;

use App\Entity\Plage;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/plage/{id<[0-9]+>}", name="affichage_plage")
     */
    public function affichage_plage(Plage $plage): \Symfony\Component\HttpFoundation\Response
    {
        $zonedeprelevements = $this->getDoctrine()->getRepository(ZoneDePrelevement::class)->findAll();
        $communes = $this->getDoctrine()->getRepository(Commune::class)->findAll();
        $departement = $this->getDoctrine()->getRepository(Departement::class)->findAll();
        $etudes = $this->getDoctrine()->getRepository(Etude::class)->findAll();


        return $this->render('plage/affichage_plage.html.twig', [
            'zonedeprelevements' => $zonedeprelevements,
            'plage' => $plage,
            'communes' => $communes,
            'departements' => $departement,
            'etudes' => $etudes

        ]);
    }
}

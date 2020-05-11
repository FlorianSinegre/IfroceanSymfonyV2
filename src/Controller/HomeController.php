<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Entity\Departement;
use App\Entity\Espece;
use App\Entity\Etude;
use App\Entity\Plage;
use App\Entity\ZoneDePrelevement;
use App\Repository\EtudeRepository;
use http\Client\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/zonedeprelevement/{id<[0-9]+>}", name="affichage_zonedeprelevement")
     */
    public function affichage_zonedeprelevement(zonedeprelevement $zonedeprelevement): \Symfony\Component\HttpFoundation\Response
    {
        $espece = $this->getDoctrine()->getRepository(Espece::class)->findAll();


        return $this->render('zonedeprelevement/show_zoneDePrelevement.html.twig', [
            'especes' => $espece,
            'zonedeprelevement' => $zonedeprelevement,
        ]);
    }
    /**
     * @Route("/home", name="home")
     */
    public function index(EtudeRepository $etudeRepository): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('etude/index.html.twig', [
            'etudes' => $etudeRepository->findAll(),
        ]);
    }
}

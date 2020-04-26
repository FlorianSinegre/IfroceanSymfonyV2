<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Entity\Departement;
use App\Entity\Espece;
use App\Entity\Etude;
use App\Entity\Plage;
use App\Entity\ZoneDePrelevement;
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
}

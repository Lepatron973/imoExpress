<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{   
    

    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $biens = $repository->findLatest();
        dump($biens[0]->getTitle());
        return $this->render('pages/home.html.twig',[
            'biens' => $biens
        ]);
    }

    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Property::Class);
        $selectedBiens = $repository->find($id);
        return $this->render('pages/bien_details.html.twig',[
            "properties" => $selectedBiens
        ]);
       
    }
}

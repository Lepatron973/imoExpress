<?php 

namespace App\Controller;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController 
{
    public function biens()
    {
        #insérer des données dans la bdd

        // $property = new Property(); initialisation de l'entité concerné
        // $property->setTitle('mon premier bien')
        // ->setPrice(200000)
        // ->setRooms(3)
        // ->setBedrooms(4)
        // ->setSurface(60)
        // ->setHeat(1)
        // ->setDescription('une petite description')
        // ->setFloor(2)
        // ->setCity('Metz')
        // ->setAddress("8 rue du grand rulut")
        // ->setPostalCode(57000);
        
        // $em = $this->getDoctrine()->getManager(); récupération de l'instance doctrine puis de son instance manager
        // $em->persist($property); enregistrement des donnée en cache
        // $em->flush(); transfert à la bdd

        $repository = $this->getDoctrine()->getRepository(Property::class);#initialisation du repo avec l'entité concerné qui contient toute les données contenue dans celle ci
        dump($repository->findOneBy(["city" => "Metz"]));
        return $this->render('pages/biens.html.twig', [
            'current_menu' => 'properties'
        ]);
    }
}

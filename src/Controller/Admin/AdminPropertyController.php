<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminPropertyController extends AbstractController 
{

   private $repository;
   private $property;
public function __contruct(){
}
public function index()
{
    $this->repository = $this->getDoctrine()->getRepository(Property::class);
    $properties = $this->repository->findAll();
    dump($properties);
    return $this->render('admin/property/admin.html.twig', [
        "properties" => $properties
        ]);
    }
    /**
     * @param Property $property
     * @param Request $req
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property,Request $req,$id)
    {
        $this->repository = $this->getDoctrine()->getRepository(Property::class);
        $em = $this->getDoctrine()->getManager();
        $properties = $this->repository->find($id);
       
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success','Bien modifié avec succès');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/property/edit.html.twig', [
            "properties" => $properties,
            "form" => $form->createView()
        ]);
    }

    /**
     * @param Request $req
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $req)
    {
        $em = $this->getDoctrine()->getManager();
        $property = new Property();
       
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($property);
            $em->flush();
            $this->addFlash('success','Bien créé avec succès');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/property/new.html.twig', [
            "properties" => $property,
            "form" => $form->createView()
        ]);
    }

    /**
     * @param Property $property
     * @param Request $req
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function delete(Property $property, Request $req)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $req->get('_token'))) {
            dump($req);
        }
        $em = $this->getDoctrine()->getManager();
        // $em->remove($property);
        // $em->flush();
        $this->addFlash('success','Bien supprimé avec succès');
        return new Response('supprimé');
        return $this->redirectToRoute('admin');
    }
}

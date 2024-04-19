<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\ClientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    //tout d'abord la base de donnée à été mise en place selon mon environement mac OS(MAMP SERVER) donc à verifie dans .env puis dans package/doctrine.yaml le 
    //faire fonctionner sur votre server local en test.
    //page d'acceuil form ajout ticket + bouton identification (à voir dans template/home/index.twig)
    //(les contraintes son mise dans la entity ticket)
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(ClientFormType::class, $ticket)->add('envoyer', SubmitType::class, [
            'label' => 'envoyer nouveau ticket'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ticket);
            $em->flush();
            $this->addFlash('success', 'le nouveau ticket à été ajouté');
            return $this->redirectToRoute('index');
        }
        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}

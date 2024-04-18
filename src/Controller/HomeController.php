<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\ClientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em,Request $request): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(ClientFormType::class,$ticket);
        $form->handleRequest($request);
        if($form->isSubmitted()){  
            // $ticket->setCloseAt(new \DateTimeImmutable());
            // $ticket->setOpenAt(new \DateTimeImmutable());
            dd($ticket);
            // $em->persist($ticket);  
            // $em->flush();
            // $this->addFlash('sucess','le nouveau ticket à été ajouté');
        return $this->redirectToRoute('index');
        }
        


     
    
        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}


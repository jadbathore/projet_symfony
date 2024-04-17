<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\ClientFormType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/admin', name: 'admin.')]
class AdminUserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TicketRepository $respository): Response
    {
        $data = $respository->findAll();
        dd($data);
        return $this->render('admin_user/index.html.twig', [
            'controller_name' => 'AdminUserController',
            ''
        ]);
    }
    #[Route('/{id}', name:'edit',requirements:['id'=> Requirement::DIGITS],methods:['GET','POST'])]
    public function edit(Request $request,Ticket $ticket,EntityManagerInterface $em):Response
    {
    $form = $this->createForm(ClientFormType::class,$ticket);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
    $em->flush();
    $this->addFlash('success', 'le ticket à bien été modifier');
    return $this->redirectToRoute('admin.category.index');
    }
        return $this->render('admin_user/create.html.twig', [
            'controller_name' => 'AdminUserController',
            
        ]);
    }
}

<?php

namespace App\Controller;
use App\Entity\Ticket;
use App\Entity\User;
use App\Form\ClientFormType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


#[Route('/ticket', name: 'ticket.')]
class TicketController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TicketRepository $respository,TokenInterface $token): Response
    {
        $user = $token->getUser();
        if (in_array('ADMINISATOR', $user->getRoles())) {
            return $this->redirectToRoute('ticket.index');
        }

    $this->denyAccessUnlessGranted('ROLE_USER');
        $data = $respository->findAll();
        return $this->render('ticket/index.html.twig', [
            'controller_name' => 'AdminUserController',
            'data' => $data
        ]);
    }
    #[Route('/{id}', name:'edit',requirements:['id'=> Requirement::DIGITS],methods:['GET','POST'])]
    public function edit(
        Request $request,
        Ticket $ticket,
        EntityManagerInterface $em,
        ):Response
    {

    $form = $this->createForm(ClientFormType::class,$ticket)
    ->add('statut',ChoiceType::class,[
            'choices' => [
                'Nouveau'=> 'Nouveau',
                'Ouvert' => 'Ouvert',
                'Résolu ' => 'Résolu',
                'Fermé' => 'Fermé',
            ]
        ])
        ->add('responsable',TextType::class,[
            'empty_data' => ''
        ])
        ->add('CloseAt',DateType::class)
        ->add('envoyer',SubmitType::class,[
            'label' => 'envoyer nouveau ticket'
        ]);
        
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
    $em->persist($ticket);
    $em->flush();

    return $this->redirectToRoute('ticket.index');
    }
        return $this->render('ticket/edit.html.twig', [
            'controller_name' => 'AdminUserController',
            'form' => $form
        ]);
    }

}

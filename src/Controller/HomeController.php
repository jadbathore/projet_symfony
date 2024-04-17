<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\ClientFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em,UserPasswordHasher $hasher): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(ClientFormType::class,$ticket);
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('sucess','le nouveau ticket à été ajouté');
        }

        $user = new User();
        $user->setEmail("testUser@test.fr")->setPassword($hasher->hashPassword($user,'password12'))->setRoles([]);
        $em->persist($user);$em->flush();
        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}

// $form = $this->createForm(CategoryType::class,$category);
//     $form->handleRequest($request);
//     if($form->isSubmitted() && $form->isValid()){
//     $em->flush();
//     $this->addFlash('success', 'la nouvelle category à bien été modifier');
//     return $this->redirectToRoute('admin.category.index');
//     }
//     return $this->render('admin/category/edit.html.twig',[
//     'form' => $form
//     ]);
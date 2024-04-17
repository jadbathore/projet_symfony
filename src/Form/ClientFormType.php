<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClientFormType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur',EmailType::class)
            ->add('CloseAt', null, [
                'widget' => 'single_text',
            ])
            ->add('description',TextareaType::class)
            ->add('categorie',ChoiceType::class,[
                'choices' => [
                    'Incident' => 'Incident',
                    'Panne' => 'Panne',
                    'Évolution' => 'Évolution',
                    'Anomalie' => 'Anomalie',
                    'Information' => 'nformation'
                ]
            ])
            ->add('statut',ChoiceType::class,[
                'choices' => [
                    'Nouveau'=> 'Nouveau',
                    'Ouvert' => 'Ouvert',
                    'Résolu ' => 'Résolu',
                    'Fermé' => 'Fermé',
                ]
            ])

            ->add('responsable')
            ->add('envoyer',SubmitType::class,[
                'label' => ' envoyer nouveau ticket'
            ])
            ->addEventListener(FormEvents::POST_SUBMIT,$this->AddDateAuto(...))
            ->addEventListener(FormEvents::PRE_SUBMIT,$this->AdminEdit_CloseAt(...))
        ;
    }
    public function AddDateAuto(PostSubmitEvent $event):void {
        $data = $event->getData();
        $data->setOpenAt(new \DateTimeImmutable());
    }
    
    public function AdminEdit_CloseAt(PreSubmitEvent $event):void{
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClientFormType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur',EmailType::class,[
                'empty_data' => ''
            ])
            ->add('description',TextareaType::class,[
                'empty_data' => ''
            ])
            ->add('categorie',ChoiceType::class,[
                'choices' => [
                    'Incident' => 'Incident',
                    'Panne' => 'Panne',
                    'Évolution' => 'Évolution',
                    'Anomalie' => 'Anomalie',
                    'Information' => 'information'
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT,$this->addAutoCompleteForClient(...))
        ;
    }

    public function addAutoCompleteForClient(PostSubmitEvent $event){
        $data = $event->getData();
        if(empty($data->getId()))
        {
            $data->setResponsable('à definir');
            $data->setStatut('Nouveau');
            $data->setOpenAt(new \DateTimeImmutable());
            $data->setCloseAt(new \DateTimeImmutable());
        }
        }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}

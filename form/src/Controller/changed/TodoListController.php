<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TodoListController extends AbstractController
{
    /**
     * @Route("/", name="todo_list")
     */
    public function index()
    {
        
        return $this->render('todo_list/index.html.twig', [
            'controller_name' => 'TodoListController',
        ]);
    }
    
    /**
     * @Route("/todo/neu", name="todo_neu")
     */
    public function newTodo(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('auftrag', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('datum', DateTimeType::class, array('attr' => array('style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('Hinzufuegen', SubmitType::class, array('attr' => array('class' => 'btn-primary' )))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            dump($form['name']->getData());
        }
        
        return $this->render('todo_list/new.html.twig', array('form' => $form->createView()));
    }
}

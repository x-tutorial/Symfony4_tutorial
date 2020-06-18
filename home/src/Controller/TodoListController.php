<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\TodoList;

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
        $todo = new TodoList();
        $form = $this->createFormBuilder()
                ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('auftrag', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('datum', DateTimeType::class, array('attr' => array('style' => 'margin-bottom:1.5em; width:50%;' )))
                ->add('Hinzufuegen', SubmitType::class, array('attr' => array('class' => 'btn-primary' )))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
             // Daten aus der Formular holen
            $name = $form['name']->getData();
            $auftrag = $form['auftrag']->getData();
            $datum = $form['datum']->getData();
            
            // Instanzvariablen weisen wir die Werte zu
            $todo->setName($name);
            $todo->setAuftrag($auftrag);
            $todo->setDatum($datum);
            
		//  Objekt von Entity Manager erstellen
            $entityManager = $this->getDoctrine()->getManager();
            // Teile Doctrine mit --> wir haben neue Werte zuspeichern (hier wird noch keine Insert in Datenbakn gemacht)
            $entityManager->persist($todo);
        
            // Und hier wird das Insert ausgeführt
            $entityManager->flush();
            
		// Wir möchten wieder auf die Startseite gelangen
            return $this->redirectToRoute('todo_list');
        }
        
        return $this->render('todo_list/new.html.twig', array('form' => $form->createView()));
    }
}

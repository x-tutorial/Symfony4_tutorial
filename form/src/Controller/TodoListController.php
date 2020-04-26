<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}

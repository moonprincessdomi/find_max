<?php
namespace App\Controller;

use App\Entity\Task;
use App\Entity\GenerateNumbers;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{
    public function new(Request $request)
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $number = explode(PHP_EOL, $task->getTask(),10);
            foreach($number as &$iter){
                // If not a string, we don't care, just parse it to 0
                $iter = intval($iter);
            }
            $max = GenerateNumbers::findMax($number);
        }
        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
            'output' => implode(PHP_EOL,$max)
        ]);
    }
}

<?php

namespace App\Controller;

use DateInterval;
use App\Entity\Tache;
use App\Form\TaskType;
use App\Repository\TacheRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TasksController extends AbstractController
{
    /**
     * @Route("/tasks", name="tasks")
     */
    public function index(TacheRepository $repo)
    {   
         
         
        $taches = $repo->findAll();
        return $this->render('tasks/index.html.twig', [
           'taches'=> $taches
         
           
        ]);
    }
/**
 * Permet de creer une tache
 * @Route("newtask", name="task_create")
 * @return Response
 */
public function create(Request $request){
    $tache = new Tache();
     $form = $this->createForm(TaskType::class, $tache); 
      $form->handleRequest($request); 
 if($form->isSubmitted() && $form->isValid()){
     $manager= $this->getDoctrine()->getManager();
            $manager->persist($tache);
            $manager->flush();
 //POUR CREER LES MSG POUR LA CONFIRAMTION DE CREATION DU FORM
           //POUR LA REDIRECTION VERSL'ANNONCE CRéER
           $this->addFlash(
                      'success',
                      "l'annonce <strong>{$tache->getTitre()}</strong> a bien étais enregistrée !"

            );
            //POUR LA REDIRECTION VERSL'ANNONCE CRéER
            return $this->redirectToRoute('task_show',[
                'slug' => $tache->getSlug()
            ]);

 }
 



    return $this->render('tasks/newtask.html.twig',[
        'form' => $form->createView()
    ]);
}
/**
     * permet d'afficher le form d'edtion
     * 
     * @Route("/tasks/{slug}/edit", name="ads_edit")
     * 
     * 
     * @return Response 
     */
public function edit(Tache $tache, Request $request){
        
        $form = $this->createForm(TaskType::class, $tache);    
         
        $form->handleRequest($request);   
        if($form->isSubmitted() && $form->isValid()){
            $nbt=$nbt+1;

           $manager= $this->getDoctrine()->getManager();
           $manager->persist($tache);
           $manager->flush();
           //POUR CREER LES MSG POUR LA CONFIRAMTION DE CREATION DU FORM
           $this->addFlash(
                     'success',
                     "l'annonce <strong>{$tache->getTitre()}</strong> a bien étais modifiée !"

           );
           //POUR LA REDIRECTION VERSL'ANNONCE CRéER
           return $this->redirectToRoute('task_show',[
               'slug' => $tache->getSlug()
           ]);
           }
               return $this->render('tasks/edittask.html.twig', [
            'form'=>$form->createView(),
            'tache'=>$tache,
            'nbt' =>$nbt
        ]);
    }


    /**
 * 
 * Permet d'afficher une seul annonce
 *
 * @Route("/tasks/{slug}", name="task_show")
 * 
 * @return Response
 */
    public function show( Tache $tache){
       
       

        return $this->render('tasks/showTask.html.twig', [
            'tache' => $tache
            ]);


    }

}

<?php

namespace App\Controller;

use App\Entity\Employer;

use App\Form\EmployerType;
use Doctrine\ORM\EntityManager;
use App\Repository\EmployerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DataController extends AbstractController
{   #[Route('/', name: 'home')] 

    public function home()
    {
      return $this->render('data/home.html.twig', [
        'slogan' => "created  by Fathima Salsabeela"
      ]); 

    }
    #[Route('/data/liste', name: 'data_liste')]
    public function liste(EmployerRepository $repo) 
    {

        $Employer =$repo->findAll();
        return $this->render('data/index.html.twig',['employer' => $Employer]);

    }
    
  
  
    #[Route('/data/new', name: 'data_new')]
    #[Route('/data/edit/{id}', name: 'data_edit')]   

    public function form(Request $globals, EntityManagerInterface $manager, Employer $employer =null)
    {  if($employer == null){
      $employer = new Employer;
      //$employer->setCreatedAt(new \DateTime);
      
    }
      

      $form = $this->createForm(EmployerType::class, $employer);

      $form->handleRequest($globals);

    

         if($form->isSubmitted() && $form->isValid()){

          
          $manager->persist($employer);
          $manager->flush();

          return $this->redirectToRoute('home', [
            'id' => $employer->getId()
          ]);
        
         }

        return $this->renderForm("data/form.html.twig",[
          'form' => $form,
          'editMode' => $employer->getId() !==null
        ]);
    }

    #[Route('/data/delete/{id}', name: 'data_delete')]
    
    public function delete(Employer $employer, EntityManagerInterface $manager )
    {
     

      $manager->remove($employer);
      $manager->flush();

      return $this->redirectToRoute('data_liste');
    
    }
}

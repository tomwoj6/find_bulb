<?php

namespace FindbulbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


//encje
use FindbulbBundle\Entity\Idea;

//formy
use FindbulbBundle\Form\Type\IdeaFormType;


class IdeaController extends Controller{    
    
    public function newAction(Request $requset){
        
        $ideaFormType = new IdeaFormType();
        $ideaForm = $this->createForm($ideaFormType, new Idea());
        
        $ideaForm->handleRequest($requset);
        if($ideaForm->isValid()){
          $em = $this->getDoctrine()->getManager();
          $ideaData = $ideaForm->getData();
          $ideaData->setUserAdd($this->getUser());
          $em->persist($ideaData);
          $em->flush();
          
          $this->get('session')->getFlashBag()->set('success', 'Dodano pomysł');
          return $this->redirectToRoute('findbulb_homepage');
        }

        return $this->render('FindbulbBundle:Idea:newIdea.html.twig', array(
            'idea' => $ideaForm->createView()
        ));
    }
    
    
    
    
}

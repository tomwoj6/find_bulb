<?php

namespace FindbulbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FindbulbController extends Controller
{
    public function indexAction(){
        
        $em = $this->getDoctrine()->getManager();
        $ideas = $em->getRepository('FindbulbBundle:Idea')->findAll();
        
        return $this->render('FindbulbBundle:Home:index.html.twig', array(
            'ideas' => $ideas
        ));
    }

}

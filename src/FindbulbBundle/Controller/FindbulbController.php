<?php

namespace FindbulbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FindbulbController extends Controller
{
    public function indexAction(){
        
        $em = $this->getDoctrine()->getManager();
        $ideas = $em->getRepository('FindbulbBundle:Idea')->findAll();
        $categories = $em->getRepository('FindbulbBundle:Category')->findAll();
        
        return $this->render('FindbulbBundle:Home:index.html.twig', [
            'ideas' => $ideas,
            'categories' => $categories
        ]);
    }

}

<?php

namespace FindbulbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function viewAction($userId){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find($userId);
        
        return $this->render('FindbulbBundle:User:profile.html.twig', array(
            'user' => $user
        ));
    }

}

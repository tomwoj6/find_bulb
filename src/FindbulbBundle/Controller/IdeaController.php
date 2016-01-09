<?php

namespace FindbulbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//encje
use FindbulbBundle\Entity\Idea;
use FindbulbBundle\Entity\IdeaHistory;
//formy
use FindbulbBundle\Form\Type\IdeaFormType;
use FindbulbBundle\Form\Type\CommentFormType;



class IdeaController extends Controller{    
    
    public function newAction(Request $requset){
        
        $ideaFormType = new IdeaFormType();
        $ideaForm = $this->createForm($ideaFormType, new Idea());
        
        $ideaForm->handleRequest($requset);
        if($ideaForm->isValid()){
          $em = $this->getDoctrine()->getManager();
          $ideaData = $ideaForm->getData();
          $ideaData->setUserAdd($this->getUser());
          
          $ideaHistory = new IdeaHistory();
          $ideaHistory->setIdea($ideaData);
          $ideaHistory->setUser($this->getUser());
          $ideaHistory->setAction('Add Idea.');
          
          $em->persist($ideaData);
          $em->persist($ideaHistory);
          $em->flush();
          
          $this->get('session')->getFlashBag()->set('success', 'Dodano pomysł');
          return $this->redirectToRoute('findbulb_homepage');
        }

        return $this->render('FindbulbBundle:Idea:newIdea.html.twig', array(
            'idea' => $ideaForm->createView()
        ));
    }
    public function viewAction($ideaId){
        $em = $this->getDoctrine()->getManager();
        //pobieramy pomysl
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        //czy istnieje
        if(!$idea){ throw $this->createNotFoundException('Bad Idea Id (ID = '.$ideaId.')');}
        //i oddzielnie jego komentarze
        $comments = $em->getRepository('FindbulbBundle:Comments')->getIdeaComments($idea->getId());
        //obrabianie komentarzy
        
//        foreach ($comments as $comment){
//            echo var_dump($comment);
           
//            echo var_dump($comment->getLevel());
//            echo var_dump($comment->getChildren()->getLevel());
            
//            $i = 1;
//            $commentArray = $comment; 

//            do {
//                echo $i.'<br/>';
//                foreach ($commentArray as $c){
//                    if(!$c->getId()){
//                        $i = 0;
//                    }else{
//                        $i = 2;
//                    }
//                    echo var_dump($i);
//                }
//            if($comment)
//                $comment = $comment->getChildren();
//                $i++;
//                echo var_dump($comment->owner);
                
//            }while ($i);
            
            
            
//        }
        
        
        
        
        
        
        
        //-----------------------
        $history = $em->getRepository('FindbulbBundle:IdeaHistory')->findByIdea($idea);
        //form dodawania komentarza
        $commentFormType = new CommentFormType();
        $commentForm = $this->createForm($commentFormType, null, array(
            'action' => $this->generateUrl('findbulb_add_comment'),
        ));
        //--------
//        return new \Symfony\Component\HttpFoundation\Response('Test');
        return $this->render('FindbulbBundle:Idea:viewIdea.html.twig', array(
            'idea' => $idea,
            'comments' => $comments,
            'history' => $history,
            'commentsForm' => $commentForm->createView()
        ));
    }
    public function upVoteAction($ideaId){
        $this->get('findbulb.vote.helper')->ideaVote($ideaId, 'up');
        $this->get('session')->getFlashBag()->set('success', 'Vote+');
        return $this->redirectToRoute('findbulb_homepage');
    }
    public function downVoteAction($ideaId){
        $this->get('findbulb.vote.helper')->ideaVote($ideaId, 'down');
        $this->get('session')->getFlashBag()->set('success', 'Vote-');
        return $this->redirectToRoute('findbulb_homepage');
    }
    
    public function editAction(Request $request, $ideaId){
        $em = $this->getDoctrine()->getManager();
        $ideaFormType = new IdeaFormType();
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        $ideaForm = $this->createForm($ideaFormType, $idea);
        $ideaForm->handleRequest($request);
        if($ideaForm->isValid()){
          $ideaData = $ideaForm->getData();
          $ideaHistory = new IdeaHistory();
          $ideaHistory->setIdea($ideaData);
          $ideaHistory->setUser($this->getUser());
          $ideaHistory->setAction('Edit Idea.');
          
          $em->persist($ideaData);
          $em->persist($ideaHistory);
          
          $em->flush();
          $this->get('session')->getFlashBag()->set('success', 'Edycja ok.');
          return $this->redirectToRoute('findbulb_homepage');
        }
        return $this->render('FindbulbBundle:Idea:editIdea.html.twig', array(
            'idea' => $ideaForm->createView()
        ));
    }
    public function closeAction($ideaId){
        $closed = $this->get('findbulb.idea.helper')->close($ideaId);
        if($closed){
            $this->get('session')->getFlashBag()->set('success', 'Successfully closed!');
            return $this->redirectToRoute('findbulb_homepage');
        }else{
            return new \Symfony\Component\HttpFoundation\Response('Error');
        }
    }
    
    
    
    
    
    public function addCommentAction(Request $request){
        $ideaId = $this->get('findbulb.comment.helper')->addComment($request);
        $this->get('session')->getFlashBag()->set('success', 'Dodano komentarz');
        return $this->redirect($this->generateUrl('findbulb_view_idea', array('ideaId' => $ideaId)));
    }
    public function delCommentAction($commentId){
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('FindbulbBundle:Comments')->find($commentId);
        $comment->setActive(false);
        $em->persist($comment);
        $em->flush();
        
        $this->get('session')->getFlashBag()->set('success', 'Comment deleted.');
        return $this->redirectToRoute('findbulb_view_idea', array('ideaId' => $comment->getIdea()->getId()));

    }
}

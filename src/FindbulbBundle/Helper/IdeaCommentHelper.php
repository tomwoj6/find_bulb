<?php

namespace FindbulbBundle\Helper;

//use 
use Symfony\Component\HttpFoundation\Request;
use FindbulbBundle\Entity\Comments;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IdeaCommentHelper{
    
    protected $tokenstorage;
    protected $doctrine;
    protected $currentUser;
    
    public function __construct($tokenstorage, $doctrine){
        $this->tokenstorage = $tokenstorage;
        $this->doctrine = $doctrine;
        $this->currentUser = $this->tokenstorage->getToken()->getUser();
    }

    public function addComment(Request $request){
        
        //komentarz
        $comment = $request->request;
        $commentText = $comment->get('comment')['text'];
        $commentParent = $comment->get('comment')['parent'];
        $commentIdea = $comment->get('comment')['idea'];
        
        $em = $this->doctrine->getManager();
        $parent = $em->getRepository('FindbulbBundle:Comments')->find($commentParent);
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($commentIdea);
        
        if($commentParent !== '' && $parent === null){
            throw new NotFoundHttpException('Bad parent(ID = '.$commentParent.')');
        }
        if(!$idea){
            throw new NotFoundHttpException('Bad Idea(ID = '.$commentParent.')');
        }
        
        $newComment = new Comments();
        $newComment->setParent($parent);
        $newComment->setIdea($idea);
        $newComment->setText($commentText);
        $newComment->setUserAdd($this->currentUser);

        $em->persist($newComment);
        $em->flush();
     
        return $commentIdea;
    }
    
}
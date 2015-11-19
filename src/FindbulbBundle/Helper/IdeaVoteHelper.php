<?php

namespace FindbulbBundle\Helper;

//use 
use FindbulbBundle\Entity\IdeaUserVotes;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IdeaVoteHelper{
    
    protected $tokenstorage;
    protected $doctrine;
    protected $currentUser;
    
    public function __construct($tokenstorage, $doctrine){
        $this->tokenstorage = $tokenstorage;
        $this->doctrine = $doctrine;
        $this->currentUser = $this->tokenstorage->getToken()->getUser();
    }

    public function ideaVote($ideaId, $voteType){
        //sprawdzamy mozliwosc glosowania
        if($this->checkVote($ideaId)){
            //glosujemy
            $this->setVote($ideaId, $voteType);
        }
        return true;
    }
    public function checkVote($ideaId){
        $em = $this->doctrine;
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        //sprawdzamy czy pomysl istnieje
        if($idea){
            //jezeli tak to pobieramy glosy danego usera w pomysle
            $userIdeaVotes = $em->getRepository('FindbulbBundle:IdeaUserVotes')->getUserVotesInIdea($this->currentUser->getId(), $idea->getId());
            //czy moge zaglosowac - nie moge jezeli glosowalem/jestem autorem
            if($idea->getUserAdd() === $this->currentUser || !empty($userIdeaVotes)){
                throw new AccessDeniedException('Access Denied');
            }else{
                //mozna glosować
                return true;
            }
        }else{
            throw new NotFoundHttpException('Bad Idea(ID = '.$ideaId.')');
        }
        return false;
    }
    public function setVote($ideaId, $voteType){
        $em = $this->doctrine->getManager();
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        $userVote = new IdeaUserVotes();
        $userVote->setUser($this->currentUser);
        $userVote->setIdea($idea);
        if($voteType === 'up'){
            $userVote->setUp(1);
        }else{
            $userVote->setDown(1);
        }
        $em->persist($userVote);
        $em->flush();
    }
}
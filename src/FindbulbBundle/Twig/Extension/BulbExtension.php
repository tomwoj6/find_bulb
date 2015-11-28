<?php

namespace FindbulbBundle\Twig\Extension;

class BulbExtension extends \Twig_Extension {

    protected $doctrine;
    protected $context;

    public function __construct($doctrine, $context) {
        $this->doctrine = $doctrine;
        $this->context = $context;
    }

    public function getFunctions() {

        return array(
            'isUserVoted' => new \Twig_Function_Method($this, 'isUserVoted'),
        );
    }

    public function isUserVoted($ideaId) {
        $em = $this->doctrine;
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        //jezeli tak to pobieramy glosy danego usera w pomysle
        $userIdeaVotes = $em->getRepository('FindbulbBundle:IdeaUserVotes')->getUserVotesInIdea($this->getUser()->getId(), $idea->getId());
        //czy moge zaglosowac - nie moge jezeli glosowalem/jestem autorem
        if($idea->getUserAdd() === $this->getUser() || !empty($userIdeaVotes)){
            //nie mozna glosowac
            return false;
        }else{
            //mozna glosować
            return true;
        }
        return false;

    }

    public function getUser() {
        return $this->context->getToken()->getUser();
    }

    public function getName() {
        return 'bulb_extension';
    }

}

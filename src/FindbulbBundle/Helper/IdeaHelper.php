<?php

namespace FindbulbBundle\Helper;

//use 
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IdeaHelper {

    protected $tokenstorage;
    protected $doctrine;
    protected $currentUser;

    public function __construct($tokenstorage, $doctrine) {
        $this->tokenstorage = $tokenstorage;
        $this->doctrine = $doctrine;
        $this->currentUser = $this->tokenstorage->getToken()->getUser();
    }

    public function close($ideaId) {
        $em = $this->doctrine->getManager();
        $idea = $em->getRepository('FindbulbBundle:Idea')->find($ideaId);
        if ($this->currentUser == $idea->getUserAdd()) {
            if ($idea) {
                $idea->setActive(0);
                $em->persist($idea);
                $em->flush();
            } else {
                throw new NotFoundHttpException('Bad Idea(ID = ' . $ideaId . ')');
            }
        } else {
            throw new AccessDeniedException('Access Denied');
        }
        return true;
    }

}

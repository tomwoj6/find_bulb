<?php

namespace FindbulbBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentsRepository extends EntityRepository{
    
    public function getIdeaComments($ideaId){
        $query = $this->createQueryBuilder('comments')
                ->where('comments.idea = :ideaId')
                ->andWhere('comments.parent is null')
                ->setParameter(':ideaId', $ideaId)
                ->getQuery();
        return $query->getResult();
    } 
}
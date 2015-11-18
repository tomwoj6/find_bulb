<?php

namespace FindbulbBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IdeaUserVotesRepository extends EntityRepository{
    
    public function getUserVotesInIdea($userId, $ideaId) {
        $query = $this->createQueryBuilder('userVotes')
                ->select('userVotes.id')
                ->where('userVotes.user = :userId')
                ->andWhere('userVotes.idea = :ideaId')
                ->setParameter(':userId', $userId)
                ->setParameter(':ideaId', $ideaId)
                ->getQuery();
        return $query->getResult();
    }
    
}
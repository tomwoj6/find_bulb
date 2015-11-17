<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository{
        
    public function getNotUserRoles($userId){
        $query = $this->createQueryBuilder('role')
              ->leftJoin('role.users', 'users' , 'WITH', 'users.id = :param')  
              ->setParameter('param', $userId)  
              ->where('users.id is NOT NULL')
              ->getQuery();

        return $query->getResult();
    }
    
    public function getDuplicateRole($name, $displayName){
        $query = $this->createQueryBuilder('role')
                ->where('role.name = :name')
                ->orWhere('role.displayName = :displayName')
                ->setParameter('name', $name)
                ->setParameter('displayName', $displayName)
                ->getQuery();
        return $query->getResult();
    }
}
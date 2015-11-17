<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository{
    
    public function getAllUserEmails() {
        $query = $this->createQueryBuilder('users')
                ->select('users.email')
                ->where('users.enabled = 1')
                ->orderBy('users.id')
                ->getQuery();
        $emails = array();
        foreach ($query->getResult() as $email){
            $emails[] = $email['email'];
        }
        return $emails;
    }
    
    public function findUserByUsername($string){
        $query = $this->createQueryBuilder('users')
           ->where('users.firstname LIKE :firstname')
           ->setParameter('firstname', '%'.$string.'%')
           ->getQuery();
        return $query->getResult();
    }
    
    public function findUserByFullname($string){
        $query = $this->createQueryBuilder('users')
           ->where('users.firstname LIKE :string')
           ->orWhere('users.lastname LIKE :string')
           ->orWhere('users.username LIKE :string_by_login')    
           ->andHaving('users.enabled = 1')
           ->setParameter('string', '%'.trim($string).'%')
           ->setParameter('string_by_login', '%'.  str_replace(' ', '.', trim($string)).'%')
           ->getQuery();
        return $query->getResult();
    }
    
}
<?php

namespace transportBundle\Repository;
use Doctrine\ORM\EntityRepository;
use transportBundle\Entity\ligneTransport;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;


class ligneTransportRepository extends \Doctrine\ORM\EntityRepository
{
//    public function findEntitiesByString($str){
//        return $this->getEntityManager()
//            ->createQuery(
//                'SELECT l
//                FROM transportBundle:ligneTransport l
//                WHERE l.station LIKE :str'
//            )
//            ->setParameter('str', '%'.$str.'%')
//            ->getResult();
//    }



}



<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 02/02/16
 * Time: 14:27
 */
namespace CoreBundle\Manager;
use Doctrine\ORM\EntityManager;

use CoreBundle\Manager\BaseManager;


class PostManager extends BaseManager
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function remove($id)
    {
        $tweet = $this->getRepository()->find($id);
        $this->entityManager->remove($tweet);
        $this->entityManager->flush();
    }

    public function findbyOrder($user)
    {
        return $this->getRepository()->findbyOrder()
                ->setParameter('user', $user)
                ->getQuery()
                ->execute();
    }

    public function getRepository()
    {
        return $this->entityManager->getRepository('CoreBundle:Post');
    }
}
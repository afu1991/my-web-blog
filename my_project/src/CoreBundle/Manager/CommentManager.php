<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 02/02/16
 * Time: 14:27
 */
namespace CoreBundle\Manager;
use CoreBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;

use CoreBundle\Manager\BaseManager;


class CommentManager extends BaseManager
{
    public $entityManager;

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

    public function create($user, $post, $commentaire)
    {
        $comment = new Comment();
        $comment->setPost($post);
        $comment->setUser($user);
        $comment->setComment($commentaire);
        $this->persistAndFlush($comment);
    }


    public function getRepository()
    {
        return $this->entityManager->getRepository('CoreBundle:Comment');
    }
}
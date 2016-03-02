<?php

namespace CoreBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Post", mappedBy="user", cascade={"remove", "persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Comment", mappedBy="user", cascade={"remove", "persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $comments;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add post
     *
     * @param \CoreBundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\CoreBundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \CoreBundle\Entity\Post $post
     */
    public function removePost(\CoreBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add comment
     *
     * @param \CoreBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\CoreBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \CoreBundle\Entity\Comment $comment
     */
    public function removeComment(\CoreBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}

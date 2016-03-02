<?php

namespace CoreBundle\Controller;

use CoreBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreBundle\Entity\Post;
use CoreBundle\Form\PostType;
use CoreBundle\Form\CommentType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        return $this->render('CoreBundle:post:index.html.twig', array(
            'posts' => $this->get('core.manager.post_manager')->findAll(),
        ));
    }

    /**
     * Creates a new Post entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('CoreBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post->setUser($this->getUser());
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home_show', array('id' => $post->getId()));
        }

        return $this->render('CoreBundle:post:new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction(Post $post)
    {
        return $this->render('CoreBundle:post:show.html.twig', array(
            'post' => $post,
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $editForm = $this->createForm('CoreBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('home_edit', array('id' => $post->getId()));
        }

        return $this->render('CoreBundle:post:edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction($id)
    {
        $this->get('core.manager.post_manager')->remove($id);
        return $this->redirectToRoute('home_index');
    }

}

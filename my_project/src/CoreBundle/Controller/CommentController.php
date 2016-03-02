<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 27/02/16
 * Time: 19:17
 */
namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{

    public function newAction(Request $request, $post_id)
    {
        if ($request->getMethod() == 'POST') {
            $this->get('core.manager.comment_manager')
                ->create(
                    $this->getUser(),
                    $this->get('core.manager.post_manager')->find($post_id),
                    $request->get('comment')
                );
            return $this->redirectToRoute('home_show', array('id' => $post_id));
        }
        return $this->redirectToRoute('home_show', array('id' => $post_id));
    }

    public function reportedAction($post_id, $comment_id, $bool)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $this->get('core.manager.comment_manager')->find($comment_id);
        $comment->setApproved($bool);
        $em->persist($comment);
        $em->flush();
        $this->addFlash('notice', "Merci d'avoir signalé, nous allons étudier le commentaire.");
        return $this->redirectToRoute('home_show', array('id' => $post_id));
    }

    public function CommentReportedAction()
    {
        $comment = $this->get('core.manager.comment_manager')->findBy('approved', true);
        return $this->render('CoreBundle:post:commentReported.html.twig', array('comments' => $comment));
    }

    public function deleteAction($id)
    {
        $this->get('core.manager.comment_manager')->remove($id);
        $this->addFlash('notice', "Le commentaire à était supprimé.");
        return $this->redirectToRoute('home_get_comment_reported');
    }
}
<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use AppBundle\Form\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;

class PostController extends FOSRestController implements ClassResourceInterface
{
    public function cgetAction()
    {
        $posts = $this->getRepository()->findAll();

        return $posts;
    }

    public function getAction($id)
    {
        $post = $this->getRepository()->find($id);

        return $post;
    }

    public function postAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', new PostType(), $post = new Post(), [
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $post;
        }

        return $form;
    }

    public function getCommentsAction($id)
    {
        $comments = $this->getRepository()->find($id)->getComments();

        return $comments;
    }

    public function postCommentAction($id, Request $request)
    {
        $comment = new Comment();
        $comment->setPost($this->getRepository()->find($id));

        $form = $this->get('form.factory')->createNamed('', new CommentType(), $comment, [
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $comment;
        }

        return $form;
    }

    private function getRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Post');
    }
}

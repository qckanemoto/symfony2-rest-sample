<?php

namespace AppBundle\Controller;

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
    }

    public function getCommentsAction($id)
    {
        $comments = $this->getRepository()->find($id)->getComments();

        return $comments;
    }

    public function postCommentAction($id, Request $request)
    {
    }

    private function getRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('AppBundle:Post');
    }
}

<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;

class PostController extends FOSRestController implements ClassResourceInterface
{
    public function cgetAction()
    {
    }

    public function getAction($id)
    {
    }

    public function postAction(Request $request)
    {
    }

    public function getCommentsAction($id)
    {
    }

    public function postCommentAction($id, Request $request)
    {
    }
}

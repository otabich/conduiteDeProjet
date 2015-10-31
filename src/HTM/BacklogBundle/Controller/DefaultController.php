<?php

namespace HTM\BacklogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HTMBacklogBundle:Default:index.html.twig', array('name' => $name));
    }
}

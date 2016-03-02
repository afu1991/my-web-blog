<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      //  $ok = $this->container->getParameter('security.role_hierarchy.roles');

        return $this->render('CoreBundle:Default:index.html.twig');
    }
}

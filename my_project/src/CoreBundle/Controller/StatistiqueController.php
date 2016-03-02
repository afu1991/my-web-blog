<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreBundle:Statistique:index.html.twig', array(
            // ...
        ));
    }

}

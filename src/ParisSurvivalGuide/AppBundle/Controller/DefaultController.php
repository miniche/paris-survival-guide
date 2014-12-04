<?php

namespace ParisSurvivalGuide\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParisSurvivalGuideAppBundle:Default:index.html.twig');
    }
}

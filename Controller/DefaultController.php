<?php

namespace Censanet\GetnetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GetnetBundle:Default:index.html.twig');
    }
}

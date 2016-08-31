<?php

namespace Aescarcha\OauthServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AescarchaOauthServerBundle:Default:index.html.twig');
    }
}

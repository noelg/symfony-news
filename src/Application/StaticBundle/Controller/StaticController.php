<?php

namespace Application\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;

class StaticController extends Controller
{
    public function aboutAction()
    {
        $response = $this->createResponse();
        $response->setSharedMaxAge(86400);

        return $this->render('StaticBundle:Static:about', array(), $response);
    }
}

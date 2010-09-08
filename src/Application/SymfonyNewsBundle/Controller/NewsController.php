<?php

namespace Application\SymfonyNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;
use Zend\Http\Client;

class NewsController extends Controller {

    public function indexAction() {
        $response = $this->createResponse();
        $response->setSharedMaxAge(86400);
        $response->setClientTtl(60);
        $response->setTtl(86400);

        return $this->render('SymfonyNewsBundle:News:index', array(), $response);
    }

    public function twitterAction($limit = 10, $standalone = true) {
        $items = $this['twitter']->get($limit);

        $response = $this->createResponse();
        $response->setSharedMaxAge(60);
        $response->setClientTtl(60);
        $response->setTtl(60);

        return $this->render('SymfonyNewsBundle:News:twitter', array('items' => $items, 'standalone' => $standalone), $response);
    }

    public function planetAction($limit = 10, $standalone = true) {
        $items = $this['planet']->get($limit);

        $response = $this->createResponse();
        $response->setSharedMaxAge(1800);
        $response->setClientTtl(1800);
        $response->setTtl(1800);

        return $this->render('SymfonyNewsBundle:News:planet', array('items' => $items, 'standalone' => $standalone), $response);
    }

    public function slideshareAction($limit = 5, $standalone = true) {
        $response = $this->createResponse();
        $response->setSharedMaxAge(10800);
        $response->setClientTtl(10800);
        $response->setTtl(10800);

        $items = $this['slideshare']->get($limit);

        return $this->render('SymfonyNewsBundle:News:slideshare', array('items' => $items, 'limit' => $limit, 'standalone' => $standalone), $response);
    }
}

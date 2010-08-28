<?php

namespace Application\SymfonyNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller;
use Zend\Http\Client;

class NewsController extends Controller {

    public function indexAction() {
        $response = $this->createResponse();
        $response->setSharedMaxAge(86400);
        $response->setClientTtl(86400);
        $response->setTtl(86400);

        return $this->render('SymfonyNewsBundle:News:index', array(), $response);
    }

    public function twitterAction($limit = 10) {
        $feed  = new \SimpleXmlElement($this->getTwitterSearch());
        $feed->registerXPathNamespace('media', 'http://search.yahoo.com/mrss/');

        $items = $feed->xpath(sprintf('//channel/item[position() <= %d]', $limit));

        $response = $this->createResponse();
        $response->setSharedMaxAge(60);
        $response->setClientTtl(60);
        $response->setTtl(60);

        return $this->render('SymfonyNewsBundle:News:twitter', array('items' => $items, 'standalone' => (10 === $limit)), $response);
    }

    public function twitterRssAction() {
        $response = $this->createResponse($this['twitter']->request()->getBody());
        $response->setSharedMaxAge(60);
        $response->setTtl(60);

        return $response;
    }

    public function planetAction($limit = 10) {
        $response = $this->createResponse();
        $response->setSharedMaxAge(1800);
        $response->setClientTtl(1800);

        $feed = new \SimpleXmlElement($this->getPlanetFeed());
        $items = $feed->xpath(sprintf('//channel/item[position() <= %d]', $limit));

        return $this->render('SymfonyNewsBundle:News:planet', array('items' => $items, 'limit' => $limit, 'standalone' => (10 === $limit)), $response);
    }

    public function planetFeedAction() {
        $response = $this->createResponse($this['planet']->request()->getBody());
        $response->setSharedMaxAge(7200);
        $response->setClientTtl(7200);
        $response->setTtl(7200);

        return $response;
    }


    public function slideshareAction($limit = 5) {
        $response = $this->createResponse();
        $response->setSharedMaxAge(10800);
        $response->setClientTtl(10800);
        $response->setTtl(10800);

        $feed = new \SimpleXmlElement($this->getSlideshareSearch());
        $items = $feed->xpath(sprintf('//Tag/Slideshow[position() <= %d]', $limit));

        return $this->render('SymfonyNewsBundle:News:slideshare', array('items' => $items, 'limit' => $limit, 'standalone' => (5 === $limit)), $response);
    }

    public function slideshareXmlAction() {
        $response = $this->createResponse($this['slideshare']->setParameterGet(array(
            'ts'    => $ts = time(),
            'hash'  => sha1($this->container->getParameter('news.slideshare.api_secret').$ts),
            'limit' => 30
        ))->request()->getBody());

        $response->setSharedMaxAge(21600);
        $response->setClientTtl(21600);
        $response->setTtl(21600);

        return $response;
    }

    public function getSlideshareSearch() {
        return $this->handleSubRequest('SymfonyNewsBundle:News:slideshareXml');
    }

    protected function getTwitterSearch() {
        return $this->handleSubRequest('SymfonyNewsBundle:News:twitterRss');
    }

    protected function getPlanetFeed() {
        return $this->handleSubRequest('SymfonyNewsBundle:News:planetFeed');
    }

    /**
     * Return the result of the action twitterRss and handle ESI if it's available
     * FIXME: Is there a best way to do that?
     * 
     * @param string $controller
     * @return string
     */
    protected function handleSubRequest($controller) {
        if ($this->container->has('esi') && $this->container->has('cache')) {
            $search = $this['esi']->handle(
                    $this['cache'],
                    $this['controller_resolver']->generateInternalUri($controller),
                    null, false);
        }
        else {
            $search  = $this['controller_resolver']->render($controller);
        }

        return $search;
    }
}

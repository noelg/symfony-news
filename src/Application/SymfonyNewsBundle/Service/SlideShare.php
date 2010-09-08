<?php


namespace Application\SymfonyNewsBundle\Service;

class SlideShare extends BaseService
{
    protected $secret;

    public function get($limit = 10)
    {
        return $this->getFeed()->xpath(sprintf('//Tag/Slideshow[position() <= %d]', $limit));
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    protected function doRequest()
    {
        return $this->client->setParameterGet(array(
            'ts'    => $ts = time(),
            'hash'  => sha1($this->secret.$ts),
            'limit' => 30
        ))->request()->getBody();
    }
}

<?php


namespace Application\SymfonyNewsBundle\Service;

abstract class BaseService
{
    protected $client;
    protected $cache;

    public function __construct($client, $cache = null)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    abstract public function get();

    protected function getFeed()
    {
        if (null !== $this->cache && $this->cache->test($this->getCacheKey()))
        {
            return new \SimpleXmlElement($this->cache->load($this->getCacheKey()));
        }

        $content = $this->doRequest();

        if (null !== $this->cache) {
            $this->cache->save($content, $this->getCacheKey());
        }

        return new \SimpleXmlElement($content);
    }

    protected function getCacheKey()
    {
        return sha1($this->client->getUri());
    }

    protected function doRequest()
    {
        return $this->client->request()->getBody();
    }

}

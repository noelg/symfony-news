<?php


namespace Application\SymfonyNewsBundle\Service;

class Rss extends BaseService
{
    public function get($limit = 10)
    {
        return $this->getFeed()->xpath(sprintf('//channel/item[position() <= %d]', $limit));
    }
}

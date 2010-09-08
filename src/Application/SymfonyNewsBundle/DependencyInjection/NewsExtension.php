<?php

namespace Application\SymfonyNewsBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Extension\Extension;
use Symfony\Components\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Components\DependencyInjection\ContainerBuilder;

class NewsExtension extends Extension {
    protected $resources = array(
            'config'     => 'config.xml',
            'planet'     => 'planet.xml',
            'twitter'    => 'twitter.xml',
            'slideshare' => 'slideshare.xml',
            'templating' => 'templating.xml',
    );

    protected function configLoad($config, ContainerBuilder $container) {
        if (!$container->hasDefinition('news.config')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['config']);
        }

        if (isset($config['cache']) && $config['cache']) {
            $container->setParameter('zend.cache.class', 'Zend\\Cache\\Backend\\File');
        }

    }

    public function planetLoad($config, ContainerBuilder $container) {

        if (!$container->hasDefinition('news.planet')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['planet']);
        }

        if (isset($config['url'])) {
            $container->setParameter('news.planet.url', $config['url']);
        }
    }

    public function twitterLoad($config, ContainerBuilder $container) {
        if (!$container->hasDefinition('news.twitter')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['twitter']);
        }

        if (isset($config['url'])) {
            $container->setParameter('news.twitter.url', $config['url']);
        }

        if (isset($config['search_query'])) {
            $container->setParameter('news.twitter.search_query', $config['search_query']);
        }
    }

    public function templatingLoad($config, ContainerBuilder $container) {
        if (!$container->hasDefinition('templating')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['templating']);
        }
    }

    public function slideshareLoad($config, ContainerBuilder $container) {
        if (!$container->hasDefinition('slideshare')) {
            $loader = new XmlFileLoader($container, __DIR__.'/../Resources/config');
            $loader->load($this->resources['slideshare']);
        }

        if (isset($config['url'])) {
            $container->setParameter('news.slideshare.url', $config['url']);
        }

        if (isset($config['api_key'])) {
            $container->setParameter('news.slideshare.api_key', $config['api_key']);
        }

        if (isset($config['api_secret'])) {
            $container->setParameter('news.slideshare.api_secret', $config['api_secret']);
        }

        if (isset($config['search_query'])) {
            $container->setParameter('news.slideshare.search_query', $config['search_query']);
        }
    }
    
    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath() {
        return __DIR__.'/../Resources/config/';
    }

    public function getNamespace() {
        return 'http://www.symfony-project.org/schema/dic/news';
    }

    public function getAlias() {
        return 'news';
    }
}
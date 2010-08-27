<?php

require_once __DIR__.'/../src/autoload.php';

use Symfony\Framework\Kernel;
use Symfony\Components\DependencyInjection\Loader\LoaderInterface;

class NewsKernel extends Kernel
{
    public function registerRootDir()
    {
        return __DIR__;
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Framework\KernelBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\ZendBundle\ZendBundle(),
            new Application\StaticBundle\StaticBundle(),
            new Application\SymfonyNewsBundle\SymfonyNewsBundle(),
        );

        if ($this->isDebug()) {
        }

        return $bundles;
    }

    public function registerBundleDirs()
    {
        return array(
            'Application'     => __DIR__.'/../src/Application',
            'Bundle'          => __DIR__.'/../src/Bundle',
            'Symfony\\Bundle' => __DIR__.'/../src/vendor/symfony/src/Symfony/Bundle',
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}

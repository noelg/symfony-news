<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta name="keywords" content="Symfony,php,blogs,twitter,Symfony 2,news" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="Noël GUILBERT" />
        <meta name="language" content="en" />
        <meta name="robots" content="index, follow, all" />

        <title><?php $view['slots']->output('title', 'Symfony-news: latest news about the symfony framework') ?></title>
        <?php echo $view['stylesheets'] ?>
    </head>
    <body>
        <a href="http://github.com/noelg/symfony-news" target="_blank" id="github" title="Fork me on github">
            <img src="/bundles/symfonynews/images/fork-me.png" alt="Fork me!" />
        </a>
        <!-- start header -->
        <div id="logo">
            <h1><a href="<?php echo $view['router']->generate('homepage') ?>">Symfony News</a></h1>
            <p>latest news about the symfony framework</p>
        </div>

        <div id="menu">
            <ul id="main" class="clear_fix">
                <li<?php echo $view['slots']->get('current_page') == 'home' ? ' class="current_page_item"' : '' ?>><a href="<?php echo $view['router']->generate('homepage') ?>">Homepage</a></li>
                <li<?php echo $view['slots']->get('current_page') == 'planet' ? ' class="current_page_item"' : '' ?>><a href="<?php echo $view['router']->generate('news_planet') ?>">Blogs</a></li>
                <li<?php echo $view['slots']->get('current_page') == 'twitter' ? ' class="current_page_item"' : '' ?>><a href="<?php echo $view['router']->generate('news_twitter') ?>">Twitter</a></li>
                <li<?php echo $view['slots']->get('current_page') == 'slideshare' ? ' class="current_page_item"' : '' ?>><a href="<?php echo $view['router']->generate('news_slideshare') ?>">Slideshare uploads</a></li>
                <li<?php echo $view['slots']->get('current_page') == 'about' ? ' class="current_page_item"' : '' ?>><a href="<?php echo $view['router']->generate('about') ?>">About</a></li>
            </ul>
        </div>
        <!-- end header -->

        <div id="wrapper">
            <!-- start page -->
            <div id="page">
                <!-- start content -->
                <div id="content" class="clear_fix">
                    <?php $view['slots']->output('_content') ?>
                </div>
                <!-- end content -->
            </div>
            <!-- end page -->
        </div>
        <div id="footer">
            <p>Powered by <a href="http://symfony-reloaded.org/" target="_blank">Symfony 2</a>.</p>
        </div>
    </body>
</html>
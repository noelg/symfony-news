<?php $view->extend('::layout') ?>
<?php $view['stylesheets']->add('bundles/symfonynews/css/default.css') ?>
<?php $view['slots']->set('title', 'An error occured | Symfony News') ?>

<div id="about_page">
    <h1><?php echo $manager->getStatusCode().' '.$manager->getStatusText() ?></h1>
</div>

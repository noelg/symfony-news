<?php $view->extend('::layout') ?>
<?php $view['stylesheets']->add('bundles/symfonynews/css/default.css') ?>
<?php $view['slots']->set('current_page', 'home') ?>

<div class="home">
    <div class="clear_fix">
        <?php echo $view['actions']->render('SymfonyNewsBundle:News:twitter', array('limit' => 10, 'standalone' => true, )) ?>
        <?php echo $view['actions']->render('SymfonyNewsBundle:News:planet', array('standalone' => true)) ?>
    </div>
    <?php echo $view['actions']->render('SymfonyNewsBundle:News:slideshare', array('standalone' => true)) ?>
</div>
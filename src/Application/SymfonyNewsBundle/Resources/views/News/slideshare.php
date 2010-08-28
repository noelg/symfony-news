<?php if (!$standalone): ?>
    <?php $view->extend('::layout') ?>
    <?php $view['stylesheets']->add('bundles/symfonynews/css/default.css') ?>
    <?php $view['slots']->set('current_page', 'slideshare') ?>
    <?php $view['slots']->set('title', 'Latest slideshare uploads tagged symfony | Symfony News') ?>
<?php endif ?>

<div id="slideshare" class="clear_fix">
  <h2>Latest slideshare uploads</h2>
  <?php foreach ($items as $item): ?>
  <div class="entry clear_fix">
    <a href="<?php echo $item->URL ?>" title="<?php echo $item->Title ?>">
      <img src="<?php echo $item->ThumbnailURL ?>" alt="<?php echo $item->Title ?>" />
      <?php echo $item->Title ?>
    </a>

    <p class="stats">
      from <a href="http://www.slideshare.com/<?php echo $item->Username ?>"><?php echo $item->Username ?></a>, posted the <?php echo $item->Created ?>
    </p>

    <p class="description">
      <?php echo $view['text']->unescape($item->Description) ?>
    </p>
  </div>
  <?php endforeach ?>
</div>
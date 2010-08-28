<?php if (!$standalone): ?>
    <?php $view->extend('::layout') ?>
    <?php $view['stylesheets']->add('bundles/symfonynews/css/default.css') ?>
    <?php $view['slots']->set('current_page', 'planet') ?>
    <?php $view['slots']->set('title', 'Latest blog post entries | Symfony News') ?>
<?php endif ?>

<div id="planet">
  <h2>Latest blog post entries</h2>
  <?php foreach ($items as $item): ?>
      <div class="entry">
          <h3 class="title">
              <a href="<?php echo $item->link ?>">
                <?php echo $item->title ?>
              </a>
              <p class="stats">
                <?php if ((string) $item->author): ?>
                  By <a href="<?php echo $item->link ?>"><?php echo $item->author?>,</a>
                <?php endif ?>
                <?php echo date('d/m/Y H:i:s', strtotime((string) $item->pubDate)) ?></p>
          </h3>
        <p>
          <?php echo $view['text']->truncateText($item->description, 250) ?>
        </p>
      </div>
  <?php endforeach ?>
</div>

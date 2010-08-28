<?php if (!$standalone): ?>
    <?php $view->extend('::layout') ?>
    <?php $view['stylesheets']->add('bundles/symfonynews/css/default.css') ?>
    <?php $view['slots']->set('current_page', 'twitter') ?>
    <?php $view['slots']->set('title', 'Latest tweets about symfony | Symfony News') ?>
<?php endif ?>

<div id="timeline">
  <h2>Latest tweets about symfony</h2>
  <?php foreach ($items as $item): ?>
  <?php $mediaContentAttributes = $item->children('http://search.yahoo.com/mrss/')->content->attributes() ?>
  <div class="entry clear_fix">
    <a class="profile_picture" href="http://twitter.com/<?php echo $view['text']->getTwitterUsername($item->author) ?>">
      <img src="<?php  echo $mediaContentAttributes['url'] ?>" alt="<?php echo $view['text']->getTwitterUsername($item->author) ?>" />
    </a>
    <p>
      <a href="http://twitter.com/<?php echo $view['text']->getTwitterUsername($item->author) ?>">
        <?php echo $view['text']->getTwitterUsername($item->author) ?>
      </a>
      <span>
        <?php echo $view['text']->unescape($item->description) ?>
      </span>
    </p>
    <p>
      <?php echo $item->pubDate ?>
    </p>
  </div>
  <?php endforeach ?>
</div>
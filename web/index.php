<?php

require_once __DIR__.'/../news/NewsCache.php';

$kernel = new NewsCache(new NewsKernel('prod', true));
$kernel->handle()->send();

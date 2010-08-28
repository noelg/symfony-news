<?php

require_once __DIR__.'/../news/NewsCache.php';

$kernel = new NewsCache(new NewsKernel('prod', false));
$kernel->handle()->send();

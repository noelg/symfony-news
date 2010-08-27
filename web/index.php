<?php

require_once __DIR__.'/../news/NewsKernel.php';

$kernel = new NewsKernel('prod', false);
$kernel->handle()->send();

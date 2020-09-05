<?php

DEFINE('SLIM_START', microtime(true));

require __DIR__ . '/../bootstrap/app.php';

$app->run();

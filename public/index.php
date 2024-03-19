<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require (APP_PATH. 'App.php');
require (VIEWS_PATH. 'transactions.php');

$files = getTransactionFiles(FILES_PATH);

foreach ($files as $file) {
    $content = getContent($file, 'parseRow');
    var_dump($content);
}

<?php

declare(strict_types = 1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require (APP_PATH. 'App.php');

$files = getTransactionFiles(FILES_PATH);

$content = [];

foreach ($files as $file) {
    $content = array_merge($content, getContent($file, 'parseRow'));
}

$totals = getTotals($content);

require (VIEWS_PATH. 'transactions.php');
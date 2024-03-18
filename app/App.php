<?php

declare(strict_types = 1);

function getTransactionFiles(string $path): array
{
    $files = [];

    foreach (array_diff(scandir($path), array('..', '.')) as $file) {
        $files[] = $path.$file;
    }

    return $files;
}

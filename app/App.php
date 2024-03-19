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

function getContent(string $file, callable $cb = null): array
{

    if (! file_exists($file)) {
        trigger_error('File "' . $file . '" does not exist.', E_USER_ERROR);
    }

    $content = [];

    $csv = fopen($file, 'r');
    while (($row = fgetcsv($csv))) {
        if ($cb !== null) {
            $row = $cb($row);
        }

        $content[] = $row;
    }

    // remove header row
    array_shift($content);

    fclose($csv);

    return $content;
}

function parseRow(array $row): array
{
    [$date, $checkNumber, $description, $amount] = $row;

    $amount = (float) str_replace(['$', ','], '', $amount);

    return [
        'date'        => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount'      => $amount,
    ];
}

function getTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}

function formatDate(string $date): string
{
    return date("M d, Y", strtotime($date));
}

function formatAmount(float $amount): string
{
    return '$'. number_format($amount, 2, '.', ',');
}


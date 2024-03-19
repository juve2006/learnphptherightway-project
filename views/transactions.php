<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                     <?php if (! empty($content)): ?>
                         <?php foreach($content as $transaction): ?>
                             <tr>
                                 <td><?= formatDate($transaction['date']) ?></td>
                                 <td style="background-color: <?= $transaction['checkNumber'] ? 'lightgreen' : 'white'?>">
                                      <?= $transaction['checkNumber']?>
                                 </td>
                                 <td><?= $transaction['description'] ?></td>
                                 <td>
                                     <?php if ($transaction['amount'] < 0): ?>
                                         <span style="color: red;">
                                        <?= formatAmount($transaction['amount'])?>
                                    </span>
                                     <?php elseif ($transaction['amount'] > 0): ?>
                                         <span style="color: green;">
                                        <?= formatAmount($transaction['amount'])?>
                                    </span>
                                     <?php else: ?>
                                         <?= formatAmount($transaction['amount']) ?>
                                     <?php endif ?>
                                 </td>
                             </tr>
                         <?php endforeach ?>

                     <?php endif;?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?php echo formatAmount($totals['totalIncome']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?php echo formatAmount($totals['totalExpense']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?php echo formatAmount($totals['netTotal']); ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>

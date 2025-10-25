<?php

require_once '../others/class/common_function.php';
$app = new setting();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'addPaidExpense') {
        $query = "INSERT INTO ims_expense (`expense_type`, `amount`, `date`, `note`) VALUES ('{$_POST['expenseType']}', '{$_POST['amount']}', '{$_POST['date']}', '{$_POST['note']}');";
        $count = $app->basic_command_query($query);
        if ($count > 0) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['action'] == 'loadPaidExpenses') {
        $subQ = "";
        if ($_POST['paidExpenseType2'] != 0) {
            $subQ = " AND ims_expense.expense_type = '{$_POST['paidExpenseType2']}'";
        }
        $query = "SELECT
                ims_expense.id, 
                ims_expense.amount, 
                ims_expense.note, 
                ims_expenses_type.expense_name, 
                ims_expense.date,
                DATE_FORMAT(date,'%Y-%m') AS expMonth
                FROM
                ims_expense
                INNER JOIN
                ims_expenses_type
                ON 
		ims_expense.expense_type = ims_expenses_type.id
                WHERE
		DATE_FORMAT(date,'%Y-%m') = '{$_POST['date']}' AND
                ims_expense.expense_status = '1'" . $subQ . "
                ORDER BY
	        ims_expense.date DESC";
        $data = $app->basic_Select_Query($query);
        $tblData = '';
        foreach ($data as $x) {
            $tblData .= '<tr>';
            $tblData .= '<td>' . $x['expense_name'] . '</td>';
            $tblData .= '<td>' . $x['amount'] . '</td>';
            $tblData .= '<td>' . $x['date'] . '</td>';
            $tblData .= '<td>' . $x['note'] . '</td>';
            if ($x['expMonth'] == date('Y-m')) {
                $tblData .= '<td><button class="my-del-btn delete" type="button"  value="' . $x['id'] . '">Delete</button></td>';
            } else {
                $tblData .= '<td>-</td>';
            }
            $tblData .= '</tr>';
        }
        echo $tblData;
    } elseif ($_POST['action'] == 'loadAddedExpensesTypes') {
        $query = "SELECT
	              ims_expenses_type.id, 
                  ims_expenses_type.expense_name
                  FROM
                  ims_expenses_type";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">Select expense type</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['id'] . '">' . $x['expense_name'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'loadAddedExpensesTypes2') {
        $query = "SELECT
	              ims_expenses_type.id, 
                  ims_expenses_type.expense_name
                  FROM
                  ims_expenses_type";
        $data = $app->basic_Select_Query($query);
        $options = '<option value="0">All</option>';
        foreach ($data as $x) {
            $options .= '<option value="' . $x['id'] . '">' . $x['expense_name'] . '</option>';
        }
        echo $options;
    } elseif ($_POST['action'] == 'delete_expense_record') {
        $query = "UPDATE `ims`.`ims_expense` SET `expense_status` = 0 WHERE `id` = '{$_POST['expenseid']}'";
        $result = $app->basic_command_query($query);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
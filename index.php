<?php

require_once './others/class/common_function.php';
$app = new setting();


if (isset($_SESSION['emp_id']) && !isset($_GET['cus'])) {
    //        ==========================Registrations============================
    if (isset($_GET['empReg'])) {
        require_once './views/emp_form.php';
    } elseif (isset($_GET['custReg'])) {
        require_once './views/cust_form.php';
    } elseif (isset($_GET['cakeReg'])) {
        require_once './views/cake_form.php';
    } elseif (isset($_GET['sample'])) {
        require_once './views/sample.php';
    } elseif (isset($_GET['grn'])) {
        require_once './views/grn_form.php';
    } elseif (isset($_GET['supReg'])) {
        require_once './views/sup_form.php';
    } elseif (isset($_GET['itemReg'])) {
        require_once './views/item_form.php';
    } elseif (isset($_GET['privMng'])) {
        require_once './views/system_previlege.php';
    } elseif (isset($_GET['login'])) {
        require_once './views/login.php';
    } elseif (isset($_GET['dashboard'])) {
        require_once './views/dashboard.php';
    } elseif (isset($_GET['stock'])) {
        require_once './views/stock_form.php';
    } elseif (isset($_GET['resetPass'])) {
        require_once './views/pass_reset.php';
    } elseif (isset($_GET['newConfig'])) {
        require_once './views/newConfig.php';
    } elseif (isset($_GET['pass'])) {
        require_once './views/pass.php';
    } elseif (isset($_GET['customConfig'])) {
        require_once './views/customConfig.php';
    } elseif (isset($_GET['viewConfig'])) {
        require_once './views/viewConfig.php';
    } elseif (isset($_GET['newOrder'])) {
        require_once './views/new_order.php';
    } elseif (isset($_GET['orderStatus'])) {
        require_once './views/order_status.php';
    } elseif (isset($_GET['reprintBill'])) {
        require_once './views/reprint_bill.php';
    } elseif (isset($_GET['grnPayment'])) {
        require_once './views/grn_payment.php';
    } elseif (isset($_GET['advanceManage'])) {
        require_once './views/advance_manage.php';
    } elseif (isset($_GET['orderDetailedStatus'])) {
        require_once './views/orderDetailedStatus.php';
//        ==========================Reports============================
    } elseif (isset($_GET['advance'])) {
        require_once './views/advanced_receipt.php';
    } elseif (isset($_GET['completedAdvance'])) {
        require_once './views/completedAdvance_receipt.php';
    } elseif (isset($_GET['outletReceipt'])) {
        require_once './views/outlet_bill.php';
    } elseif (isset($_GET['report'])) {
        require_once './others/reports/printableReport.php';
    } elseif (isset($_GET['CustomerSummary'])) {
        require_once './others/reports/customer_summary.php';
    } elseif (isset($_GET['employeeSummary'])) {
        require_once './others/reports/employee_summary.php';
    } elseif (isset($_GET['supplierSummary'])) {
        require_once './others/reports/supplier_summary.php';
    } elseif (isset($_GET['orderSummary'])) {
        require_once './others/reports/order_summary.php';
    } elseif (isset($_GET['outletorderSummary'])) {
        require_once './others/reports/oultet_order_summary.php';
    } elseif (isset($_GET['lowItems'])) {
        require_once './others/reports/low_items.php';
    } elseif (isset($_GET['grnSummary'])) {
        require_once './others/reports/grn_summary.php';
    } elseif (isset($_GET['grnDetailed'])) {
        require_once './others/reports/grn_detailed.php';
    } elseif (isset($_GET['charts'])) {
        require_once './views/charts.php';
    } elseif (isset($_GET['reportsGenerate'])) {
        require_once './views/reportGenerate.php';
    } elseif (isset($_GET['outletStockUpdate'])) {
        require_once './views/outlet_stock_update.php';
    } elseif (isset($_GET['outletSale'])) {
        require_once './views/outlet_management.php';
    } elseif (isset($_GET['expensesGenerate'])) {
        require_once './views/expenses.php';
    } else {
        require_once './views/login.php';
    }
} elseif (isset($_GET['cus'])) {
    switch ($_GET['cus']) {
        case 'customerHome':
            require_once './views/customer_home.php';
            break;
        case 'customerRegistration':
            require_once './views/cust_reg.php';
            break;
        case 'custLogin':
            require_once './views/cust_login.php';
            break;
        case 'custDetails':
            require_once './views/more_cake_details.php';
            break;
        default:
            require_once './views/login.php';
            break;
    }
} else {
    require_once './views/login.php';
}
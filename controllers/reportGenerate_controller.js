localStorage.setItem('reportType', 1);

$('.radio').click(function () {
    var value = $(this).val();
    if (value == 1) {
        $('.dateRange').addClass('d-none');
        localStorage.setItem('reportType', 1);
    } else {
        $('.dateRange').removeClass('d-none');
        localStorage.setItem('reportType', 2);
    }
});

$('#generateBtn').click(function () {
    var allOk = true;
    var fromDate = $('#startDate').val();
    var toDate = $('#endDate').val();
    var reportType = $('#reportType').val();
    var batchNo = $('#batchNo').val();
    var type = localStorage.getItem('reportType');

    if (type == 2 && reportType > 3) {
        if (fromDate == '') {
            allOk = false;
            $('#startDate_msg').text("Select start date");
        } else {
            $('#startDate_msg').text("");
        }

        if (toDate == '') {
            allOk = false;
            $('#endDate_msg').text("Select end date");
        } else {
            $('#endDate_msg').text("");
        }

        if (reportType == "0") {
            allOk = false;
            $('#reportType_msg').text("Select report type");
        } else {
            $('#reportType_msg').text("");
        }
    } else if (reportType == "6") {
        if (batchNo == ''){
            allOk = false;
            $('#batchNo_msg').text("Enter batch number");
        } else {
            $('#batchNo_msg').text("");
        }
    }

    if (allOk) {
        generateReport();
    }
});

$('#resetForm').click(function () {
    reset_form();
});

$('#reportType').change(function () {
    if ($(this).val() == "0") {
        $('#reportType_msg').text("Select report type");
    } else {
        if ($(this).val() > 3) {
            $('.selectReportType').removeClass('d-none');
        } else {
            $('.selectReportType').addClass('d-none');
            $('.dateRange').addClass('d-none');
        }
        if ($(this).val() == 6) {
            $('.enterBatchNo').removeClass('d-none');
            $('.dateRange').addClass('d-none');
            $('.selectReportType').addClass('d-none');
            loadAvailableGRNNo();
        } else {
            $('.enterBatchNo').addClass('d-none');

        }
        $('#reportType_msg').text("");
    }
});

$('#startDate').change(function () {
    if ($(this).val == '') {
        $('#startDate_msg').text("Select start date");
    } else {
        $('#startDate_msg').text("");
    }
});

$('#endDate').change(function () {
    if ($(this).val == '') {
        $('#endDate_msg').text("Select start date");
    } else {
        $('#endDate_msg').text("");
    }
});

$('#batchNo').keyup(function () {
    this.value = this.value.replace(/[a-zA-Z]/g, '');
    if ($(this).val = '') {
        $('#batchNo_msg').text("Enter batch number");
    } else {
        $('#batchNo_msg').text("");
    }
});

$('#batchNo').change(function () {
    if ($(this).val == '0') {
        $('#batchNo_msg').text("Select batch number");
    } else {
        $('#endDate_msg').text("");
    }
});

//==============================================================================

function generateReport() {
    var type = localStorage.getItem('reportType');
    var reportType = $('#reportType').val();
    var batchNo = $('#batchNo').val();
    var fromDate = "";
    var toDate = "";
    if (type == 2) {
        var fromDate = $('#startDate').val();
        var toDate = $('#endDate').val();
    }
    if (reportType == 1) {
        window.location = "./?employeeSummary";
    } else if (reportType == 2) {
        window.location = "./?supplierSummary";
    } else if (reportType == 3) {
        window.location = "./?CustomerSummary";
    } else if (reportType == 4) {
        if (type == 1) {
            window.location = "./?orderSummary&all";
        } else {
            window.location = "./?orderSummary&from=" + fromDate + "&to=" + toDate;
        }
    } else if (reportType == 5) {
        if (type == 1) {
            window.location = "./?grnSummary&all";
        } else {
            window.location = "./?grnSummary&from=" + fromDate + "&to=" + toDate;
        }
    } else if (reportType == 6) {
        // if (type == 1) {
        //     window.location = "./?grnDetailed&all";
        // } else {
        window.location = "./?grnDetailed&batchNo=" + batchNo;
        // }
    } else if (reportType == 7) {
        if (type == 1) {
            window.location = "./?outletorderSummary&all";
        } else {
            window.location = "./?outletorderSummary&from=" + fromDate + "&to=" + toDate;
        }
    }
}

function reset_form() {
    $('#reportType').val('0');
    $('#startDate').val("");
    $('#endDate').val("");
    $('input[name="reportType"]').prop('checked', '1');

    $('.enterBatchNo').addClass('d-none');
    $('.selectReportType').addClass('d-none');
    $('.dateRange').addClass('d-none');

    $('#startDate_msg').text("");
    $('#endDate_msg').text("");
    $('#reportType_msg').text("");
    $('#batchNo_msg').text("");
}

function loadAvailableGRNNo(){
    var dataArray = {action: 'loadAvailableGRNNo'};
    $.post('./models/reportGenerate_model.php', dataArray, function (reply) {
        $('#batchNo').html(reply);
    });
}
loadAddedStockTable();
getLowItems();

$('#search').keyup(function () {
    loadAddedStockTable();
});

// =======================================================================================================================


function loadAddedStockTable() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedStockTable', search: search}
    $.post('./models/stock_model.php', dataArray, function (reply) {
        $('#addedStock_tbl tbody').html('').append(reply);

        $('.select').click(function () {
            get_emp_data_for_update($(this).val());
            $('#oldPassRow').removeClass('d-none');
        });
        $('.delete').click(function () {
            var id = $(this).val();
            alertify.confirm("Confirm Delete", "Are you sure, You want to delete this Record ?",
                function () {
                    delete_emp_record(id);
                },
                function () {
                    alertify.error('Delete Cancel');
                });
        });
    });
}

function getLowItems() {
    var dataArray = {action: 'getLowItems'}
    $.post('./models/login_model.php', dataArray, function (reply) {
        $('#lowQunt').html(parseInt(reply));
    });
}

$('#printLowQty').click(function () {
    window.location = './?lowItems';
});
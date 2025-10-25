loadOldBill();

$('#search').keyup(function () {
    loadOldBill();
});

// =======================================================================================================================


function loadOldBill() {
    var search = $('#search').val();
    var dataArray = {action: 'loadOldBill', search: search}
    $.post('./models/reprint_bill_model.php', dataArray, function (reply) {
        $('#oldBill_tbl tbody').html('').append(reply);

        $('.reprintBill').click(function () {
           window.location = "./?outletReceipt&reprint&billNo=" + $(this).val();
        });
    });
}
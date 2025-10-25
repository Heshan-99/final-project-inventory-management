loadCakes();

$('#search').keyup(function () {
    loadCakes();
});

// =======================================================================================================================

function loadCakes() {
    var search = $('#search').val();
    var dataArray = {action: 'loadCakes', search:search}
    $.post('./models/customer_home_model.php', dataArray, function (reply) {
        $('#listProductContainer').html('').append(reply);
        // $('.listProductItem').click(function () {
            $('.detailsbtn').click(function () {
                navigateToCakeDetails($(this).val());
            // });
        });
    });
}

function navigateToCakeDetails(cakeid){
    window.location =  './?cus=custDetails&cakeId=' + cakeid;
}
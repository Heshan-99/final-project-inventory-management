$('#plusBtn').click(function () {
    increaseQty();
});

// $('#minBtn').click(function () {
//     form_validation();
// });

function increaseQty(){
    var cakeQty = parseInt($('#cakeQty').val());
    var finalQty = cakeQty + 1;

    // $('#cakeQty').val(finalQty);
    console.log(finalQty);
}
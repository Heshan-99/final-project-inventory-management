loadAddedConfig();

$('#search').keyup(function () {
    loadAddedConfig();
});

// =====================================================================================================================

function loadAddedConfig() {
    var search = $('#search').val();
    var dataArray = {action: 'loadAddedConfig',search:search}
    $.post('./models/viewConfig_model.php', dataArray, function (reply) {
        $('#configs').html('').append(reply);
        $('#photoPreview').attr('src', './others/upload_cake_designs/'+value.photo);
    });
}
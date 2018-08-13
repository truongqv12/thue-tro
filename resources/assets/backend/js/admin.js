$('#browse_file').on('click',function (e) {
    $('#adm_avatar').click();
});

$('#adm_avatar').on('change', function (e) {
    var fileInput = this;
    console.log(fileInput.files[0]);
    if (fileInput.files[0]){
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img').attr('src', e.target.result);
        };
        reader.readAsDataURL(fileInput.files[0]);
    };
});
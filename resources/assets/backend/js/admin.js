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
    }
});
// ajax info
$('.ajax-show-info').on("click",function(){
    var adm_id =  $(this).data("id");

    $.ajax({
        type: "GET",
        url: 'ajax/info/' + adm_id,
        data: {
        },
        success: function (result) {
            console.log(result);
            $(".modal-body").html(result);
        },
        error: function(){
            console.log("Lỗi data");
        }
    });
});
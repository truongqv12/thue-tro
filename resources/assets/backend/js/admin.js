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

// ajax delete
// $('.btn-delete-js').on("click",function(){
//     var adm_id =  $(this).data("id");
//
//     if (confirm('Bạn muốn xóa không')){
//         $.ajax({
//             type: "GET",
//             url: 'administration/delete',
//             data: {
//                 adm_id: adm_id,
//             },
//             success: function (result) {
//                 // $('.comfirm-icon').css({'visibility': 'visible'});
//                 console.log('thanh cong');
//             },
//         });
//     }
//     else{
//         console.log('Xóa thất bại');
//     }
// });
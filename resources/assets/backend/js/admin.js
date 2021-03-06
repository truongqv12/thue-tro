$('#browse_file').on('click',function () {
    $('#adm_avatar').click();
});

$('#adm_avatar').on('change', function () {
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
    var url_info =  $(this).data("url");
    $('.load_content_modal_ajax').hide();
    $('.loading_view').show();
    setTimeout (function() {
        $.ajax({
            type: "GET",
            url: 'ajax/' + url_info,
            data: {
            },
            beforeSend: function() {
                $('.load_content_modal_ajax').hide();
                $('.loading_view').show();
            },
            success: function (result) {
                console.log(result);
                $('.loading_view').hide();
                $('.load_content_modal_ajax').show();
                $('.load_content_modal_ajax').html(result);
            },
            error: function(){
                console.log("Lỗi data");
            }
        });
    }, 300);
});

//Tạo slug tự động
$('input#name').keyup(function() {
    /* Act on the event */
    var title, slug;

    //Lấy text từ thẻ input title
    title = $(this).val();

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    $('input#slug').val(slug);

});

//Viết hoa chữ đầu dòng
$.fn.capitalize = function () {
    $.each(this, function () {
        var split = this.value.split(' ');
        for (var i = 0, len = split.length; i < len; i++) {
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1).toLowerCase();
        }
        this.value = split.join(' ');
    });
    return this;
};

$('input#name').on('keyup', function () {
    $(this).capitalize();
}).capitalize();
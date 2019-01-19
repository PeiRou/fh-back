//验证上传图片的大小 类型
function checkImage (file) {
    if(!/image\/\w+/.test(file.type)){
        return '图片类型不对';
    }
    if(file.size > 1024 * 1024 * 3){
        return '文件过大';
    }
    return false;
}
$(function(){
    $('#file').change(function(){
        var file = this.files[0];
        var info = checkImage(file)
        if(info){
            return alert(info);
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (e) {
            $('#qrCodeBase64').val(this.result);
        }
    })
})
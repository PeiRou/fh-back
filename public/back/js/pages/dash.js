$(function () {
    $.ajax({
        url:'http://info.platform.wuxianplay.com/dash_info.json',
        dataType:'json',
        type:'get',
        success:function (result) {
            console.log(result);
        }
    })
});
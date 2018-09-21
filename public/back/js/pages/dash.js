$(function () {
    $.ajax({
        url:'https://info.platform.wuxianplay.com/dash_info.json',
        dataType:'json',
        type:'get',
        success:function (result) {
            console.log(result);
        }
    })
});
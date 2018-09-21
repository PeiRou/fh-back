$(function () {
    $.ajax({
        url:'https://info.platform.wuxianplay.com/dash_info.json',
        dataType:'jsonp',
        type:'get',
        success:function (result) {
            console.log(result);
        }
    })
});
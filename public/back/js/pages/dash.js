$(function () {
    $.ajax({
        url:'https://raw.githubusercontent.com/wx-games/wx_update/master/platform_notice.json',
        type:'get',
        success:function (result) {
            console.log(result);
        }
    })
});
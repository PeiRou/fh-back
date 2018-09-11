$(function () {
    $.ajax({
        url:'https://raw.githubusercontent.com/wx-games/wx_update/master/platform_notice.json?token=Ao9LFTXiKf1db9b8y90e0tDv0XUeqQmdks5boHfUwA%3D%3D',
        type:'get',
        dataType:'json',
        success:function (result) {
            console.log(result);
        }
    })
});
$(function () {
    var url = 'https://info.platform.wuxianplay.com/dash_info.json';
    $.ajax({
        url:url,
        dataType:"jsonp",
        jsonpCallback:"callback",
        success:function(data){
            console.log(data);
        }
    });
});
$(function () {
    var url = 'https://info.platform.wuxianplay.com/dash_info.json';
    $.ajax({
        url:url,
        dataType:"JSONP",
        jsonp:"callback",
        jsonpCallback:"success_jsonpCallback",
        success:function(data){
            var updateInfo = data.items;
            var updateInfoText = "";
            updateInfo.forEach(function (value) {
                updateInfoText += "<a>"+value.title+"</a>"
            })
            $('#systemUpdateMessageBox').html(updateInfoText);
        }
    });
});
$(function () {
    var url = 'https://info.platform.wuxianplay.com/dash_info.json';
    var url_download = 'https://info.platform.wuxianplay.com/dash_download.json';
    $.ajax({
        url:url,
        dataType:"JSONP",
        jsonp:"callback",
        jsonpCallback:"success_jsonpCallback",
        success:function(data){
            var updateInfo = data.items;
            var updateInfoText = "";
            updateInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                updateInfoText += "<a href='"+value.url+"' "+target+" class='dash_link'>【"+value.time+"】 "+value.title+"</a>"
            })
            $('#systemUpdateMessageBox').html(updateInfoText);
        }
    });
    $.ajax({
        url:url_download,
        dataType:"JSONP",
        jsonp:"callback",
        jsonpCallback:"success_jsonpCallback",
        success:function(data){
            var downloadInfo = data.items;
            var updateInfoText = "";
            downloadInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                updateInfoText += "<a href='"+value.url+"' "+target+" class='dash_link'>【"+value.time+"】 "+value.title+"</a>"
            })
            $('#downloadMessageBox').html(updateInfoText);
        }
    });
});
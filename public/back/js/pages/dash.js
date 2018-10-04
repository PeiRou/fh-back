$(function () {
    var url = 'https://info.platform.wuxianplay.com/dash_info.json';
    $.ajax({
        url:url,
        dataType:"JSONP",
        jsonp:"callback",
        jsonpCallback:"success_jsonpCallback",
        success:function(data){
            var updateInfo = data.updateInfoItems;
            var downLoadInfo = data.downLoadItems;
            var updateInfoText = "";
            var downLoadText = "";
            updateInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                updateInfoText += "<a href='"+value.url+"' "+target+" class='dash_link'>【"+value.time+"】 "+value.title+"</a>"
            });
            downLoadInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                downLoadText += "<a href='"+value.url+"' "+target+" class='dash_link'>【"+value.time+"】 "+value.title+"</a>"
            });
            $('#systemUpdateMessageBox').html(updateInfoText);
            $('#downloadMessageBox').html(downLoadText);
        }
    });
});
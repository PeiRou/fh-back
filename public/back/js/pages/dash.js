var msg_alert_val=new Array();
var msg_alert_notice=new Array();
var msg_alert_download=new Array();
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
            var noticeInfo = data.noticeItems;
            var updateInfoText = "";
            var downLoadText = "";
            var noticeText = "";
            var msg_alert = "";

            var ii = 0;
            noticeInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                if(value.hasOwnProperty('click')){
                    msg_alert = "msg_alert_notice";
                    msg_alert_notice[ii] = value.click;
                } else {
                    msg_alert = "";
                    msg_alert_notice[ii] = "";

                }
                noticeText += "<a href='"+value.url+"' "+target+" class='dash_link "+ msg_alert +"' id='not_" + ii + "'>【"+value.time+"】 "+value.title+"</a>"
                ii = ii + 1;
            });
            var ii = 0;
            updateInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                if(value.hasOwnProperty('click')){
                    msg_alert = "msg_alert";
                    msg_alert_val[ii] = value.click;
                } else {
                    msg_alert = "";
                    msg_alert_val[ii] = "";

                }
                updateInfoText += "<a href='"+value.url+"' "+target+" class='dash_link "+ msg_alert +"' id='msg_" + ii + "'>【"+value.time+"】 "+value.title+"</a>"
                ii = ii + 1;
            });
            var ii = 0;
            downLoadInfo.forEach(function (value) {
                if(value.url != "#"){
                    var target = "target='_blank'";
                } else {
                    var target = "";
                }
                if(value.hasOwnProperty('click')){
                    msg_alert = "msg_alert_download";
                    msg_alert_download[ii] = value.click;
                } else {
                    msg_alert = "";
                    msg_alert_download[ii] = "";

                }
                downLoadText += "<a href='"+value.url+"' "+target+" class='dash_link "+ msg_alert +"' id='down_" + ii + "'>【"+value.time+"】 "+value.title+"</a>"
                ii = ii + 1;
            });
            $('#noticeMessageBox').html(noticeText);
            $('#systemUpdateMessageBox').html(updateInfoText);
            $('#downloadMessageBox').html(downLoadText);
            baseInit();
        }
    });
});
function baseInit() {
    $('.msg_alert_notice').click(function () {
        var type = "msg";
        var thisId = $(this).attr('id').substr(4);
        var thisValue = msg_alert_notice[thisId];
        msg = thisValue.content + thisValue.title + "<a href='" + thisValue.url + "'>" + "</a>";
        add(thisValue.content,thisValue.title,thisValue.url,type);
        console.log(msg_alert_notice);
    });
    $('.msg_alert').click(function () {
        var type = "doc";
        var thisId = $(this).attr('id').substr(4);
        var thisValue = msg_alert_val[thisId];
        msg = thisValue.content + thisValue.title + "<a href='" + thisValue.url + "'>" + "</a>";
        add(thisValue.content,thisValue.title,thisValue.url,type);
    });
    $('.msg_alert_download').click(function () {
        var type = "down";
        var thisId = $(this).attr('id').substr(5);
        var thisValue = msg_alert_download[thisId];
        msg = thisValue.content + thisValue.title + "<a href='" + thisValue.url + "'>" + "</a>";
        add(thisValue.content,thisValue.title,thisValue.url,type);
    });
}

function add(content,thisValue,url,type) {
    jc1 = $.confirm({
        theme: 'material',
        title: '提示',
        closeIcon:true,
        boxWidth:'25%',
        content: 'url:/back/modal/alert?content='+content+'&type='+type+'&value='+thisValue+'&url='+url,
        buttons: {
            formSubmit: {
                text:'确定',
                btnClass: 'btn-blue'
            }
        }
    });
}

function promptToll(offer) {
    if(offer == 1)
        Calert('您有未缴纳的平台费用,为了不影响您的正常使用,请及时缴纳.谢谢.','red');
}
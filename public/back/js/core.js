/**
 * Created by vincent on 2018/1/23.
 */
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    // var wsUri ="ws://103.99.60.20:9505";
    // ws = new WebSocket(wsUri);//新建立一个连接
    // //初始化Socket连接
    // function Socket_Init() {
    //     webSocket();
    // }
    // function webSocket() {
    //     ws.onopen = function(evt){
    //         // ws.send('Test!');
    //         onOpen(evt)
    //     };
    //     ws.onmessage = function(evt){
    //         onMessage(evt)
    //         // console.log(evt.data);
    //     };
    //     ws.onclose = function(evt){
    //         onClose(evt)
    //         // console.log('WebSocketClosed!');
    //     };
    //     ws.onerror = function(evt){
    //         onError(evt)
    //         // console.log('WebSocketError!');
    //     };
    // }
    // function onOpen(evt) {
    //     send('PushService Online');
    // }
    // function onMessage(evt) {
    //     console.log(evt.data)
    // }
    // function onClose(evt) {
    //     console.log('WebSocket Closed!'+evt)
    // }
    // function onError(evt) {
    //     console.log('WebSocket Error!'+evt)
    // }
    // //Send
    // function send(message) {
    //     console.log(message);
    // }
    // Socket_Init();
    checkRecharge();

    //今天
    $('#btnToday').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/today',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //昨天
    $('#btnYesterday').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/yesterday',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //本周
    $('#btnWeek').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/week',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //本月
    $('#btnMonth').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/month',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //本月
    $('#btnMonth_ym').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/month_ym',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //上个月
    $('#btnLastMonth').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/lastMonth',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start);
                $('#timeEnd').val(data.end);
            }
        })
    });
    //上个月
    $('#btnLastMonth_ym').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/lastMonth',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start.substring(0,7));
                $('#timeEnd').val(data.end.substring(0,7));
            }
        })
    });
    //上上个月
    $('#btnLastLastMonth_ym').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/lastlastMonth',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start.substring(0,7));
                $('#timeEnd').val(data.end.substring(0,7));
            }
        })
    });
    //近两月
    $('#btnLastTwoMonth_ym').on('click',function () {
        $.ajax({
            url:'/recharge/selectData/dateChange/lastthisMonth',
            type:'get',
            dataType:'json',
            success:function (data) {
                $('#timeStart').val(data.start.substring(0,7));
                $('#timeEnd').val(data.end.substring(0,7));
            }
        })
    });
});


function checkRecharge() {
    var audio = $("#rechargeSound")[0];
    var audio2 = $('#darwingSound')[0];

    $('#rechargeCount').html(localStorage.getItem('rechargeNums'));
    $('#drawingCount').html(localStorage.getItem('DrawNums'));

    var time1 = setInterval(function () {
        nowCount = localStorage.getItem('rechargeNums');
        nowDrawCount = localStorage.getItem('DrawNums');
        $.ajax({
            url:'/back/status',
            type:'get',
            dataType:'json',
            success:function (data) {
                if(data.status === true){
                    $('#onlineUserCount').html(data.onlineUser);
                    $('#onlineUserCountPC').html(data.onlineUserPC);
                    $('#onlineUserCountM').html(data.onlineUserM);
                    $('#onlineUserCountIOS').html(data.onlineUserIOS);
                    $('#onlineUserCountAND').html(data.onlineUserAND);
                    $('#onlineAdminCount').html(data.onlineAdmin);
                    $('#feedbackCount').html(data.feedbackCount);
                    if(data.feedbackCount > 0){
                        $('#feedbackContent').css('color','red');
                    }

                    if(nowCount == null){
                        ling = data.count;
                        localStorage.setItem('rechargeNums',ling);
                        if(data.count !== 0){
                            $('#rechargeCount').html(data.count);
                            audio.play();
                        } else {
                            $('#rechargeCount').html(data.count);
                        }
                    } else {
                        if(nowCount == data.count){
                            $('#rechargeCount').html(data.count);
                        } else {
                            count = data.count;
                            localStorage.setItem('rechargeNums',count);
                            $('#rechargeCount').html(data.count);
                            audio.play();
                        }
                    }

                    if(nowDrawCount == null){
                        ling2 = data.drawCount;
                        localStorage.setItem('DrawNums',ling2);
                        if(data.drawCount !== 0){
                            $('#drawingCount').html(data.drawCount);
                            audio2.play();
                        } else {
                            $('#drawingCount').html(data.drawCount);
                        }
                    } else {
                        if(nowDrawCount == data.drawCount){
                            $('#drawingCount').html(data.drawCount);
                        } else {
                            count2 = data.drawCount;
                            localStorage.setItem('DrawNums',count2);
                            $('#drawingCount').html(data.drawCount);
                            audio2.play();
                        }
                    }
                    //console.log(nowCount+'===='+data.count);
                    //console.log(nowDrawCount+'===='+data.drawCount);
                }else{
                    clearInterval(time1);
                    Calert(data.msg,'red','nonLogin')
                }
            }
        })
    },3000)
}

jconfirm.defaults = {
    theme: 'material',
    animateFromElement: false,
    animation: 'zoom',
    useBootstrap: false,
    boxWidth: '30%',
    draggable: false
};

$('.nav-item>a').on('click',function(){
    if (!$('.nav').hasClass('nav-mini')) {
        if ($(this).next().css('display') == "none") {
            $('.nav-item').children('ul').slideUp(300);
            $(this).next('ul').slideDown(300);
            $(this).parent('li').addClass('nav-show').siblings('li').removeClass('nav-show');
        }else{
            $(this).next('ul').slideUp(300);
            $('.nav-item.nav-show').removeClass('nav-show');
        }
    }
});

function Calert(content,color,type) {
    $.alert({
        icon: 'warning sign icon',
        type: color,
        title: '提示',
        content: content,
        boxWidth: '20%',
        buttons: {
            ok:{
                text:'确定',
                action: function(){
                    if(type=='nonLogin')
                        location.href='/back/control'
                }
            }
        }
    });
}

function loader(d) {
    if(d === true){
        $('.loading-mask').fadeIn();
    }else{
        $('.loading-mask').fadeOut();
    }
}

function refreshTable(table) {
    $('#'+table).DataTable().ajax.reload(null,false);
}

function Cmodal(title,boxWidth,url,needValidate,valiForm) {
    if(needValidate === true) {
        var formSubmit = {
            text:'确定提交',
            btnClass: 'btn-blue',
            action: function () {
                var form = this.$content.find('#'+valiForm).data('formValidation').validate().isValid();
                if(!form){
                    return false;
                }
                return false;
            }
        }
    } else {
        var formSubmit = {
            text:'关闭'
        }
    }
    jc = $.confirm({
        theme: 'material',
        title: title,
        closeIcon:true,
        boxWidth:boxWidth,
        content: 'url:'+url,
        buttons: {
            formSubmit: formSubmit
        },
        contentLoaded: function(data, status, xhr){
            $('.jconfirm-content').css('overflow','hidden');
            if(data.status == 403)
            {
                this.setContent('<div class="modal-error"><span class="error403">403</span><br><span>您无权进行此操作</span></div>');
                $('.jconfirm-buttons').hide();
            }
        }
    });
}

function logout() {
    $.confirm({
        title: '确定退出？',
        theme: 'material',
        type: 'orange',
        boxWidth:'20%',
        content: '我们强烈建议，如果您无需使用系统，请务必退出当前账号！',
        buttons: {
            confirm: {
                text:'退出',
                btnClass: 'btn-orange',
                action: function(){
                    $.ajax({
                        url:'/action/admin/logout',
                        type:'post',
                        dataType:'json',
                        success:function (data) {
                            if(data.status == true)
                            {
                                location.href='/back/control'
                            }
                        }
                    });
                    return false;
                }
            },
            cancel:{
                text:'取消'
            }
        }
    });
}
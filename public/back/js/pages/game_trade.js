$(function () {
    if(userId == 0){
        $('#menu-gameManage').addClass('nav-show');
        $('#menu-gameManage-tradeSetting').addClass('active');
    } else {
        $('#menu-userManage').addClass('nav-show');
        $('#menu-userManage-user').addClass('active');
    }
    $('.menu .item').tab({
        context: $('#context1')
    });
});
$('.sub-item ul li').on('click',function () {
    loader(true);
    $('.sub-item ul li').removeClass('active');
    var dataTag = $(this).attr('data-tag');
    var dataId = $(this).attr('data-id');
    if(userId == 0){
        var url = "/game/trade/tables/" + dataId;
    } else {
        var url = "/game/trade/tables/" + dataId + "?userId=" + userId;
    }
    $('#'+dataTag+'_content').load(url,function (data,status,xhr) {
        loader(false);
    });
    $(this).addClass('active');
});
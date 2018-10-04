$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-tradeSetting').addClass('active');

    $('.menu .item').tab({
        context: $('#context1')
    });
});

$('#gameTabs a').on('click',function () {
    loader(true);
    var dataTab = $(this).attr('data-tab');
    var dataType = $(this).attr('data-type');
    var url = "/game/trade/tables/"+dataType;
    $('#'+dataType+'_content').load(url,function (data,status,xhr) {
        loader(false);
    });
});
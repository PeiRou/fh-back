$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-handicapSetting').addClass('active');

    $('.menu .item').tab({
        context: $('#context1')
    });
});

$('#gameTabs a').on('click',function () {

});
$('.sub-item ul li').on('click',function () {
    loader(true);
    $('.sub-item ul li').removeClass('active');
    var dataTag = $(this).attr('data-tag');
    var dataId = $(this).attr('data-id');
    var url = "/game/tables/"+dataId;
    $('#'+dataTag+'_content').load(url,function (data,status,xhr) {
        if(status == 'success'){
            loader(false);
        } else {
            loader(false);
        }
    });
    $(this).addClass('active');
});

$('#gameOddsForm').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: $('#gameOddsForm').attr('action'),
        type: 'POST',
        data: $('#gameOddsForm').serialize(),
        success: function(result) {
            if(result.status == true){
                alert('ok')
            }
        }
    });
});
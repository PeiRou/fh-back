$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-tradeSetting').addClass('active');

    $('.menu .item').tab({
        context: $('#context1')
    });
});
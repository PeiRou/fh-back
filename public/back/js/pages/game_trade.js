$(function () {
    $('#menu-gameManage').addClass('nav-show');
    $('#menu-gameManage-tradeSetting').addClass('active');

    $('.menu .item').tab({
        context: $('#context1')
    });
});

$('#gameTabs a').on('click',function () {
    var dataTab = $(this).attr('data-tab');
    var dataType = $(this).attr('data-type');
    alert(dataTab+dataType);
});
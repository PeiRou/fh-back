$(function () {
    // $(document).pjax('a', '#agentContent')

    // $(document).pjax('a[target!=_blank]', '#agentContent', {
    //     fragment: '#agentContent'
    // });
});

function go(id) {
    $.pjax({
        url: '/agent/member',
        container: '#agentContent',
        fragment: '#agentContent'
    });
}

function errorTips(data) {
    if(data){
        $('.errorTips').show().html(data);
        setTimeout(function () {
            $('.errorTips').hide().html("");
        },3000)
    }
}
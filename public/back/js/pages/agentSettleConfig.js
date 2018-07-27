var dataTable;

$(function () {

    $('#menu-agentManage').addClass('nav-show');
    $('#menu-agentManage-setting').addClass('active');

});

function edit() {
    var form = $('#editArticleForm');
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(result) {
            if(result.status == true){
                Calert(result.msg,'green');
            }else{
                Calert(result.msg,'red');
            }
        }
    });
}

function del(a) {
    $(a).parent().parent().remove();
}

function add() {
    var html = "<tr>" +
        "<td><input type='text' name='profitStart[]' value='0'/>元</td>" +
        "<td><input type='text' name='profitEnd[]' value='0'/>元</td>" +
        "<td><input type='text' name='proportion[]' value='0'/></td>" +
        "<td><a href='javascript:;' onclick='del(this)'>删除</a></td>" +
        "</tr>";
    $('#capitalDetailsTable1').append(html);
}
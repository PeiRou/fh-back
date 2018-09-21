$(function () {
    var url = 'https://info.platform.wuxianplay.com/dash_info.json';
    $.jsonp({
        "url": url,
        "success": function(data) {
            console.log(data);
        },
        "error": function(d,msg) {
            alert("Could not find user "+msg);
        }
    })
});
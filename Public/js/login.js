$(function () {
    $(".btn").click(sub);
})
window.onload = function () {
    document.onkeydown = function (e) {
        let ev = document.all ? window.event : e;
        if (ev.keyCode == 13) {
            sub();
        }
    }
}
let submiting = false;
function sub() {
    if (submiting) {
        return;
    }
    let username = $("input[name='username']").val().replace(/\s/g, '');
    let preg = /^[\w]{5,16}$/;
    if (!preg.test(username)) {
        $.warn("请输入正确的登录名");
        return;
    }
    let pwd = $("input[name='pwd']").val().replace(/\s/g, '');
    if (!preg.test(pwd)) {
        $.warn("请输入正确的密码");
        return;
    }
    submiting = true;
    $.ajax({
        url: '/admin/login/sub',
        data: 'username='+username+'&pwd='+pwd,
        type: 'post',
        error: function (res) {
            submiting = false;
            $.warn("服务器忙，请重试");
        },
        success: function (res) {
            if (res.result == 'SUCCESS') {
                $.suc(res.msg, function () {
                    window.location = res.url;
                });
            } else {
                submiting = false;
                $.warn(res.msg);
            }
        }
    })
}
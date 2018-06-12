<div>
    <div class="google-title">绑定账号：<?php echo e($account); ?></div>
    <div style="text-align: center;margin-top: 20px;">
        <div class="google-mask">
            <span></span>
        </div>
        <img id="codeImg" src="<?php echo e($qrCodeUrl); ?>">
        <div style="font-size: 12px;color: #afafaf;">需要在您的手机中下载Google Authenticator应用</div>
        <hr>
        <div class="google-bind-tips">扫码绑定或输入<code><?php echo e($google_code); ?></code>绑定</div>
    </div>
    <div style="text-align: center;padding-top: 20px;">
        <button class="ui black button" onclick="changeQrCode('<?php echo e($subAccountId); ?>')">更换二维码</button>
    </div>
</div>
<script>
    function changeQrCode(id) {
        $.confirm({
            title: '确定要更换Google OTP验证码吗？',
            theme: 'material',
            type: 'orange',
            boxWidth:'20%',
            content: '更换完成后，请务必重新完成二维码绑定，否则将无法登录或其他操作。',
            buttons: {
                confirm: {
                    text:'确定更换',
                    btnClass: 'btn-orange',
                    action: function(){
                        $('.google-mask span').html('请稍后');
                        $('.google-mask').fadeIn();
                        $.ajax({
                            url:'/action/admin/changeGoogleCode',
                            type:'post',
                            data:{'id':id},
                            dataType:'json',
                            success:function (data) {
                                if(data.status == true){
                                    setTimeout(function () {
                                        $('#codeImg').attr('src',data.msg.qrCodeUrl);
                                        $('.google-bind-tips code').html(data.msg.code);
                                        $('.google-mask span').html('更新完成');
                                        $('.google-mask').fadeOut();
                                    },2000)
                                } else {
                                    setTimeout(function () {
                                        $('.google-mask span').html(data.msg);
                                        $('.google-mask').fadeOut();
                                    },2000)
                                }
                            }
                        });
                    }
                },
                cancel:{
                    text:'取消'
                }
            }
        });
    }
</script>
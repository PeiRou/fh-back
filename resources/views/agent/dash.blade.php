@extends('agent.layout')

@section('content')
    <div class="agent-tit">位置：<span id="pagePos">代理商首页</span></div>
    <div id="agentContent">
        <div class="index" >
            <div class="tit clearfix">
                <div class="head fl">
                    <i class="icon-head-l"></i>
                </div>
                <div class="info fl">
                    <p class="hello">
                        <span>晚上好, </span>
                        <span class="usernick">{{ Session::get('agent_name') }}</span>
                    </p>
                    <p id="lgtype" class="lgtype">
                        您上次登录IP：<span>203.177.24.121</span>，时间：<span>2018-04-02 23:51:23</span>本次登录IP：<span>203.177.24.121</span>
                    </p>
                </div>
            </div>
            <div class="agenturl">
                <div class="mintit">
                    <i class="icon-light"></i>
                    您当前的身份是<span>代理</span>，以下是您的推广链接</div> <div class="list"><p><a href="https://www.a98001.com/?intr=cs01" style="display: inline;"><span id="agentUrl">https://{{ $_SERVER['HTTP_HOST'] }}/?intr={{ Session::get('agent_account') }}</span></a>
                        <button id="copyAgentUrl" data-clipboard-action="copy" data-clipboard-target="#agentUrl">复制推广链接</button>
                    </p>
                </div>
            </div>
            <div class="nofundpwd">
                <div class="mintit">
                    <i class="icon-money"></i>以下是当前您的资金情况</div> <p>您未设置资金密码 无法显示详情。
                    <button class="">设置</button>
                </p>
            </div>
        </div>
        <script src="/agent_back/js/clipboard.min.js"></script>
        <script>
            var clipboard = new Clipboard('#copyAgentUrl');
            clipboard.on('success', function(e) {
                errorTips('推广链接复制成功')
            });
        </script>
    </div>
@endsection
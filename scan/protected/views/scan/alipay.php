<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="zh_CN">
    <title>支付宝</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script src="/static/js/jquery/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/js/jquery/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .wrap {
        position: fixed;
        bottom: 15%;
    }

    .wrap .bg {
        width: 50%;
        margin: 0 auto;
    }

    .wrap .bg .pt {
        padding: 0 5px;
    }

    .bottom {
        width: 100%;
        height: 50px;
        line-height: 50px;
        position: fixed;
        bottom: 0px;
        text-align: center;
        background: #fff;
        font-size: 16px;
        color: #00A0E9;
        font-weight: bold;
    }

    #show {

        font-weight: bold;
    }
</style>
<body style="width:100%;background: url(<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/redenvolpe/red.jpg) no-repeat;background-size:100%;">
<div class="wrap">
    <div class='bg' onclick="clickBtn(this,'<?= $model['shang_ali_pay_url']; ?>')">
        <div class="pt">
            <img src="/static/scan/images/redenvolpe/ling.png" style="width:100%"/>
        </div>
    </div>
</div>
<div class="bottom" onclick="payBtn(this,'<?= $model['ali_pay_url']; ?>')"><span>点击立即支付..<span id="show">5</span>秒</span></div>
</body>
</html>
<script type="text/javascript">
    var t = 4; // 设定跳转的时间
    setInterval("refer()", 1000); // 启动1秒定时
    function refer() {
        if (t == 0) {
            location.href = '<?= $model['ali_pay_url']; ?>'; // 设定跳转的链接地址
        }
        document.getElementById('show').innerHTML = "" + t; // 显示倒计时
        t--; // 计数器递减
    }

    function clickBtn(obj, url) {
        saveCookie();
        window.location.href = url;
    }

    function payBtn(obj, url) {
        window.location.href = url;
    }

    function saveCookie() {
        var timer = null;
        var time = new Date();
        var timeStr = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
        $.cookie('redEnvelopes', timeStr, {expires: 1});
    }

</script>
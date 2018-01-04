<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="zh_CN">
    <title></title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script src="/static/js/jquery/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/js/jquery.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
<div class="wrap">
    <div>
        <div class="pt" style="padding-top: 20px;">
            <div id="qrcode" style="margin: 0 auto;width: 90%;"></div>
            <div style="text-align: center;padding-top: 20px;font-size: "><span>长按识别加好友</span></div>
        </div>
    </div>

</div>
</body>
</html>
<script type="text/javascript">
    window.onload = function () {
        var width = document.body.clientWidth * 0.9;
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: width,
            height: width
        });
        qrcode.makeCode("<?php if (isset($model['wechat_url'])) echo $model['wechat_url'];?>");
        document.getElementById("send").onclick = function () {
            qrcode.makeCode(document.getElementById("getval").value);
        }
    }

</script>

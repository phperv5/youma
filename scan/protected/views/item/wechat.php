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
        <div class="pt" style="padding-top: 80px;">
            <div id="qrcode" style="display: none;"></div>
            <div id="imagQrDiv" style="margin: 0 auto;width: 80%;"></div>
            <div style="text-align: center;padding-top: 20px;font-size:16px; "><span>长按识别加群和好友</span></div>
        </div>
    </div>

</div>
</body>
</html>
<script type="text/javascript">
    $(function () {
        var width = document.body.clientWidth * 0.8;
        $('#qrcode').qrcode({
            width: width,//单位是像素
            height: width,
            text: "<?php if (isset($model['wechat_url'])) echo $model['wechat_url'];?>"
        });
        //获取网页中的canvas对象
        var mycanvas = document.getElementsByTagName('canvas')[0];
        //将转换后的img标签插入到html中
        var img = convertCanvasToImage(mycanvas);

        $('#imagQrDiv').append(img);//imagQrDiv表示你要插入的容器id
    })

    function convertCanvasToImage(canvas) {
        //新Image对象，可以理解为DOM
        var image = new Image();
        // canvas.toDataURL 返回的是一串Base64编码的URL，当然,浏览器自己肯定支持
        // 指定格式 PNG
        image.src = canvas.toDataURL("image/png");
        return image;
    }
</script>

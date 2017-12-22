<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="zh_CN">
    <title>网址跳转</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta content="modeName=750-12" name="grid"/>
    <script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.2/??flexible_css.js,flexible.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/favicon.ico?v=20170320">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/url/css/url.css?v=1">
</head>

<body>
<div class="content">
    <div class="url-box">
        <div class="top">
            您将要访问网址
        </div>
        <div class="url">
            <?php echo $model['ios_url']; ?>
        </div>
    </div>
    <div class="QQPCMgr">
        <img class="icon" src="/static/url/img/QQPCMgr.jpg"/>该网址已经过电脑管家安全监测:<?php echo $info['msg']; ?>
    </div>
    <a class="link-btn" href="<?php echo $model['ios_url']; ?>">
        立即访问
    </a>
    <!--<div class="why">
        <div class="why-title">
            为什么会出现此中间页面？
        </div>
        <div class="why-content">
            经腾讯电脑管家监测，您访问的网址不在系统白名单中，为保证安全以及符合网监部门的相关规定，扫码之后将跳转到此中间页面！
        </div>
    </div>-->
</div>
<footer class="footer">
    <a href="https://www.hotapp.cn/">芝麻二维码</a>
</footer>
</body>
</html>
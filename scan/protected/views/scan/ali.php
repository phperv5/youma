<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="zh_CN">
    <title></title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <script src="/static/js/jquery/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/js/jquery/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
</head>
<style>
    .wrap{
        position:fixed;
        bottom: 15%;      
    } 
    .wrap .bg{
        width: 50%;
        float: left;
    }
    .wrap .bg .pt{
        padding:0 5px;
    }
</style>
<body style="width:100px;background: url(<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/redenvolpe/red.jpg) no-repeat;background-size:100%;">
    <div class="wrap">
        <div class='bg' onclick="payBtn(this,'<?= $model['ali_pay_url'];?>')">
            <div class="pt">
                <img src="/static/scan/images/redenvolpe/gopay.png" style="width:100%" />
            </div>
        </div>
       
        <div class='bg' onclick="clickBtn(this,'<?= $model['shang_ali_pay_url'];?>')">
            <div class="pt">
            <img src="/static/scan/images/redenvolpe/ling.png" style="width:100%" />
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    function clickBtn(obj, url) {
        var timer = null;
        var time = new Date();
        var timeStr = time.getFullYear() + "-" + (time.getMonth() + 1) + "-" + time.getDate();
        $.cookie('redEnvelopes', timeStr, {expires: 1});
        window.location.href = url;
    }
    function payBtn(obj, url) {
        window.location.href = url;
    }
</script>
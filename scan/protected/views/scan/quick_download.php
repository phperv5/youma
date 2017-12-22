<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $model['app_title']; ?></title>
    <meta name="description" content="<?php echo $model['app_desc']; ?>" />
    <meta name="keywords" content="<?php echo $model['app_title']; ?>" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico?v=20170320">
    <!-- 引入YDUI样式 -->
    <link rel="stylesheet" href="/static/libs/ydui/css/ydui.css" />
    <!-- 引入YDUI自适应解决方案类库 -->
    <script src="/static/libs/ydui/js/ydui.flexible.js"></script>
    <style type="text/css">
        body,html,.main{
            width: 100%;
            height: 100%;
        }
        .main{
            background: #fff;
        }
        .main .top{
            background: #4688fa;
        }
        .main .tiitle{
            font-size: .3rem;
            text-align: center;
            padding: .38rem 0;
            color: #fff;
            font-weight: 400;
        }
        .down_tips_img{
            text-align: center;
        }
        .down_tips_img img{
            width: 5.2rem;
            margin: 0 auto;
        }
        .top_arrow{
            margin: .2rem 0;
        }
        .top_arrow img{
            width: .18rem;
            margin: 0 auto;
        }
        .main .desc{
            color: #fff;
            font-size: .24rem;
            text-align: center;
        }
        .main .desc .icon{
            display: inline-block;
            vertical-align: middle;
            margin-right: .1rem;
        }
        .icon_01{
            width: .28rem;
            height: .28rem;
        }
        .icon_02{
            width: .28rem;
            height: .30rem;
        }
        .main .bottom{
            padding: .4rem .5rem;
            background: #fff;
        }
        .down-btn{
            display: block;
            width: 100%;
            height: .7rem;
            line-height: .7rem;
            font-size: .3rem;
            color: #fff;
            background: #4688fa;
            margin-bottom: .3rem;
        }
        .countDown{
            text-align: center;
            font-size: .24rem;
            color: #333;
        }
        .countDown .time{
            color: #4688fa;
        }
    </style>
</head>
<body>
<div class="main">
    <div class="top">
        <h3 class="tiitle"><?php echo $model['app_title']; ?></h3>
        <div class="down_tips_img">
            <img src="/static/quick-download/img/down_bg.png" />
        </div>
        <div class="top_arrow">
            <img src="/static/quick-download/img/top_arrow.png" />
        </div>
        <div style="color: #fff;text-align: center; font-size: .3rem;margin-bottom: .6rem;">即将进入以上页面下载此应用 </div>
        <div class="desc"><img class="icon icon_01" src="/static/quick-download/img/icon_01.png" />此应用来自应用宝市场</div>
        <div class="desc" style="padding-top: .35rem;padding-bottom: .6rem;"><img  class="icon icon_02" src="/static/quick-download/img/icon_02.png" />已通过腾讯电脑管家安全监测，可放心下载</div>
    </div>
    <div class="bottom">
        <button class="btn down-btn" onclick="down()">下载应用</button>
        <div class="countDown">
            即将进入下载 <span id="time" class="time">3</span> 秒
        </div>
    </div>
</div>
<input id="app_title" type="hidden" name="app_title" value="<?php echo $model['app_title']; ?>" />
<textarea id="app_desc" type="hidden" hidden="hidden" name="app_desc" value=""><?php echo $model['app_desc']; ?></textarea>
<textarea id="app_detail" type="hidden" hidden="hidden" name="app_detail" value=""><?php echo $model['app_detail']; ?></textarea>
<input id="app_link" type="hidden" name="app_link" value="<?php echo $model['app_link']; ?>" />
<input id="app_imgUrl" type="hidden" name="app_imgUrl" value="<?php echo $model['app_img']; ?>" />
<input id="access_key" type="hidden" name="access_key" value="<?php echo $model['access_key']; ?>" />
<input id="baseUrl" type="hidden" name="baseUrl" value="<?php echo Yii::app()->request->baseUrl; ?>" />
<!--高速下载-->
<input type="hidden" name="appstore" id="appstore" value="<?php if(isset($model['direct_download_url'])) {echo $model['direct_download_url'];}  ?>" />
<input type="hidden" name="andorid_download_url" id="andorid_download_url" value="<?php if(isset($model['andorid_download_url'])) {echo $model['andorid_download_url'];}  ?>" />
<!-- 引入jQuery -->
<script src="/static/libs/jquery/jquery-3.2.1.min.js"></script>
<!-- 引入YDUI脚本 -->
<script src="/static/libs/ydui/js/ydui.js"></script>
<script>
    function down(){
        var andorid_download_url = $('#andorid_download_url').val();
        if(andorid_download_url){
            $('body').append("<iframe src='"+andorid_download_url+"' frameborder=0 width=0 height=0 marginheight=0 marginwidth=0 scrolling=no></iframe>");
        }
    }
    var i = 3;
    var timer = null;
    timer = setInterval(function(){
        i--;
        $('#time').text(i);
        if(i == 0){
            clearInterval(timer);
            down();
        }
    }, 1000)
</script>
</body>
</html>

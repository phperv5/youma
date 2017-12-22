<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="zh_CN">
	<title><?php echo $model['app_title']; ?></title>
	<meta name="description" content="<?php echo $model['app_desc']; ?>" />
    <meta name="keywords" content="<?php echo $model['app_title']; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/favicon.ico?v=20170320">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/css/base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/css/scan_wechat.css">
</head>

<body>
    <?php 

    if ($os == 'android') {
         $backgroud = $model['backgroud_picture_android'];
     } else {
         $backgroud = $model['backgroud_picture_ios'];
    }

    ?>
    <div class="tip_wrap" style="background-image: url(<?php echo $backgroud ?>);">
        <?php if($model['check_status'] == $model['newQrCode']) {?>
        <!--未审核的提示-->
        <div class="check_tips">
            未审核，剩余扫描次数：<?php echo $model['leftTimes'] ?>
        </div>
        <?php } ?>
        <div class="phone-tips" id="phone-tips"></div>
        <div id="footer">
            <!--点赞和分享-->
            <div class="btn_warp" id="zan_share">
                <ul class="btn-group">
                    <li style="margin-left: 0;">
                        <a href="javascript:;" class="zan-btn btn" onclick="setLike('<?php echo $model['access_key']; ?>')"> 
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/icon/zan2.png"/>
                            <span>赞</span>(<span id="like_num"><?php echo $model['like_num']; ?></span>)
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/msg/message/?access_key=<?php echo $model['access_key']; ?>" class="liuyan-btn btn">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/images/icon/liuyan_03.png"/>
                            <span>留言</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--<div class="zhima_generalize">
                <a href="http://2bai.co/13194780" class="g-link"><img class="g-img" src="/ad/ad_201703211515.jpg"/></a>
            </div>-->
            <div class="powered_by">
                <?php if(!$model['isVip']){?>
                <a class="powered"  href="https://hotapp.cn/?src=weixin">powered by 芝麻二维码 HotApp.cn</a>
                <?php }?>
                <a class="complaint" href="<?php echo Yii::app()->request->baseUrl; ?>/msg/complain/?access_key=<?php echo $model['access_key']; ?>">投诉</a>
            </div>
        </div>
    </div>
    <input id="app_title" type="hidden" name="app_title" value="<?php echo $model['app_title']; ?>" />
    <input id="app_desc" type="hidden" name="app_desc" value="<?php echo $model['app_desc']; ?>" />
    <input id="app_detail" type="hidden" name="app_detail" value="<?php echo $model['app_detail']; ?>" />
    <input id="app_link" type="hidden" name="app_link" value="<?php echo $model['app_link']; ?>" />
    <input id="app_imgUrl" type="hidden" name="app_imgUrl" value="<?php echo $model['app_img']; ?>" />
	<input id="access_key" type="hidden" name="access_key" value="<?php echo $model['access_key']; ?>" />
    <input id="baseUrl" type="hidden" name="baseUrl" value="<?php echo Yii::app()->request->baseUrl; ?>" />
    <input type="hidden" name="appstore" id="appstore" value="<?php if(isset($model['direct_download_url'])) {echo $model['direct_download_url'];}  ?>" />
    <input type="hidden" name="andorid_download_url" id="andorid_download_url" value="<?php if(isset($model['andorid_download_url'])) {echo $model['andorid_download_url'];}  ?>" />
    
    <input type="hidden" name="hidden" id="appId" value="<?php echo $signPackage['appId'] ?>" />
    <input type="hidden" name="timestamp" id="timestamp" value="<?php echo $signPackage['timestamp'] ?>" />
    <input type="hidden" name="nonceStr" id="nonceStr" value="<?php echo $signPackage['nonceStr'] ?>" />
    <input type="hidden" name="signature" id="signature" value="<?php echo $signPackage['signature'] ?>" />
    
    <script src="/static/scan/js/zepto.min.js"></script>
    <script src="/static/scan/js/baidu.js"></script>
    <script src="/static/scan/js/scan.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
    <script>
         wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo $signPackage['appId'] ?>', // 必填，公众号的唯一标识
            timestamp: '<?php echo $signPackage['timestamp'] ?>', // 必填，生成签名的时间戳
            nonceStr: '<?php echo $signPackage['nonceStr'] ?>', // 必填，生成签名的随机串
            signature: '<?php echo $signPackage['signature'] ?>',// 必填，签名，见附录1
            jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });
        wx.ready(function () {
            var app_title = $('#app_title').val();
            var app_desc = $('#app_desc').val();
            var app_link = $('#app_link').val();
            var app_imgUrl = $('#app_imgUrl').val();
            var access_key = $('#access_key').val();
            var config = {
                title: app_title + " - 芝麻", // 分享标题
                link: app_link, // 分享链接
                desc: app_desc, // 分享描述
                imgUrl: app_imgUrl, // 分享图标
                success: function (e) { 
                    // 用户确认分享后执行的回调函数
                },
            }
            wx.onMenuShareTimeline(config);

            wx.onMenuShareAppMessage(config);

            wx.onMenuShareQQ(config);
        });
    </script>
    <script>
        // ios高速下载
    	var appstore = $('#appstore').val();
    	if(appstore){
    		document.write("<iframe src='"+appstore+"' frameborder=0 width=0 height=0 marginheight=0 marginwidth=0 scrolling=no></iframe>");
    	}
    	// andorid高速下载
    	var andorid_download_url = $('#andorid_download_url').val();
        if(andorid_download_url){
            document.write("<iframe src='"+andorid_download_url+"' frameborder=0 width=0 height=0 marginheight=0 marginwidth=0 scrolling=no></iframe>");
        }
	</script>
</body>
</html>
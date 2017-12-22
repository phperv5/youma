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
	<link rel="shortcut icon" type="image/x-icon" href="/static/scan/images/favicon.ico?v=20170320">
	<link rel="stylesheet" href="/static/scan/css/scan_wechat.css?v=2017091201"  type="text/css">
</head>

<body>
    <?php 

    if ($os == 'android') {
         $backgroud = $model['backgroud_picture_android'];
     } else {
         $backgroud = $model['backgroud_picture_ios'];
    }

    ?>
    <!--未审核的提示-->
     <?php if($model['check_status'] == $model['newQrCode']) {?>
        <div class="check_tips"> 未审核，剩余扫描次数：<?php echo $model['leftTimes'] ?></div>
    <?php } ?>
    <div class="browser-prompt">
        <div class="img-box">
            <img src="<?php echo $backgroud ?>" alt="<?php echo $model['app_desc']; ?>">
        </div>
    </div>
    <div id="footer" class="footer">
        <!--点赞和分享-->
        <div class="btn_warp" id="zan_share">
            <ul class="btn-group">
                <li style="margin-left: 0;">
                    <a href="javascript:;" class="zan-btn btn" onclick="tapLike()"> 
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
        <?php if(!isset($model['is_customize_domain']) || empty($model['is_customize_domain'])) { ?>
        <div class="powered_by">
            <?php if(!$model['isVip']){?>
            <a class="powered"  href="https://www.hotapp.cn/?src=weixin">powered by 芝麻二维码 HotApp.cn</a>
            <?php }?>
            <?php if($type!='preview'){ ?> 
                <a class="complaint" href="<?php echo Yii::app()->request->baseUrl; ?>/msg/complain/?access_key=<?php echo $model['access_key']; ?>">投诉应用</a>
            <?php }?>
        </div>
        <?php }?>
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
    <!--微信-->
    <input type="hidden" name="appId" id="appId" value="<?php echo $signPackage['appId'] ?>" />
    <input type="hidden" name="timestamp" id="timestamp" value="<?php echo $signPackage['timestamp'] ?>" />
    <input type="hidden" name="nonceStr" id="nonceStr" value="<?php echo $signPackage['nonceStr'] ?>" />
    <input type="hidden" name="signature" id="signature" value="<?php echo $signPackage['signature'] ?>" />
    <script src="/static/scan/js/jquery.min.js"></script>
    <script src="/static/scan/js/scan.js?v=2017091201"></script>
    <script type="text/javascript">
    	//点赞
		function tapLike(){
		    $('.zan-btn').addClass('active');
		    setLike(function(data){
		    	$('.zan-btn').removeClass('active');
		    	$("#like_num").text(data.data);
		    	alertTip(data.msg);
		    })
		}
    </script>
</body>
</html>
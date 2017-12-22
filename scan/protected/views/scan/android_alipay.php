<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="zh_CN">
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
	<title><?php echo $model['app_title']; ?></title>
</head>

<body>
    <?php 
		if ($os == 'android') {
			$backgroud = $model['backgroudPictureAlipay'];
		} else {
			$backgroud = $model['backgroudPictureAlipay'];
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
                            <!--{{ $data['access_key'] }}-->
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
    <input id="app_link" type="hidden" name="app_link" value="<?php echo $model['app_link']; ?>" />
    <input id="app_imgUrl" type="hidden" name="app_imgUrl" value="<?php echo $model['app_img']; ?>" />
	<input id="access_key" type="hidden" name="access_key" value="<?php echo $model['access_key']; ?>" />
    <input id="baseUrl" type="hidden" name="baseUrl" value="<?php echo Yii::app()->request->baseUrl; ?>" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/js/zepto.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/js/baidu.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/js/scan.js"></script>
</body>
</html>
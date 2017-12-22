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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/css/css.css">
	<title><?php echo $model['app_title']; ?></title>
	<style type="text/css">
		html,body,.tip_wrap{width: 100%;height: 100%;}
	</style>
</head>

<body>
	<div class="tip_wrap" >
		<div class="weibo_tips_ios" style="text-align: center;padding-top: 20px;" >
			<span style="color: black;font-size: 17px;">请点击右上角,用Safari打开,下载应用</span>
		</div>
	</div>
	<p class="powered" style="width: 100%; line-height: 30px;position: absolute;bottom: 0;text-align: center;font-style: 14px;font-family: "微软雅黑";">
		<a style="color: #999;" href="http://hotapp.cn?src=weixin">powered by 芝麻二维码 HotApp.cn</a>
	</p>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/js/baidu.js"></script>
</body>
</html>



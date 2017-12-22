<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="email=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico?v=20170320">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/scan/css/base.css">
	<title>芝麻二维码</title>
	<style type="text/css">
		.bottom{
			width: 100%;
			font-size: 14px;
			text-align: center;
			color: #ddd;
			z-index: 97;
			position: fixed;
			bottom: 0;
			line-height: 24px;
			padding-bottom: 10px;
		}
		.warp{
			width: 100%;
			height: 100%;
			background: #333;
			position: fixed;
			top: 0;
			left: 0;
			opacity: 0.5;
			z-index: 98;
		}
		.main{
			position: fixed;
			top: 0;
			width: 100%;
			height: 100%;
			z-index: 99;
		}
		.main .tips_top,
		.main .tips_bottom{
			margin-top: 30%;
			text-align: center;
			font-size: 18px;
			color: #000;
		}
		.main .tips_bottom{
			margin-top: 10%;
		}
	</style>
</head>
<body>
	<div class="warp"></div>
	<div class="main">
		<div class="tips_top">
			<?php echo $msg['top']; ?>
		</div>
		<div class="tips_bottom">
			<?php echo $msg['bottom']; ?>
		</div>
	</div>
	<div class="bottom">
		<p>芝麻二维码，一站式二维码生成服务商</p>
		<p>www.hotapp.cn</p>
	</div>
</body>
</html>
